<?php

namespace App\Livewire\Teller\Autopay;

use App\Models\Fms\FmsAutopayGuarantor;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Traits\Teller\Autopay\ListOfGuarantor as AutopayListOfGuarantor;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;
use WireUi\Traits\Actions;

class ListOfGuarantor extends Component
{
    use Actions, WithPagination, AutopayListOfGuarantor;

    public $refBankIbt;
    public $selectedMbr;
    public bool $generalModal = false;
    public $modalName;
    public $method;

    #[Rule('required')]
    public $mbrNo;

    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $bank;

    #[Rule('required')]
    public $amount;

    #[Rule('required')]
    public $accountNo;

    #[Rule('required')]
    public $status;

    protected $popupService;

    public function __construct()
    {
        $this->popupService = new PopupService();
    }

    public function mount()
    {
        $this->refBankIbt = BankIbtService::getAllRefBankIbts();
    }

    public function generateExcel()
    {
        $rawData = FmsAutopayGuarantor::select('mbrno', 'name', 'bank', 'amount', 'account_no', 'status')->get();

        $columnMappings = [
            'mbrno' => 'Membership No',
            'name' => 'Name',
            'bank' => 'Bank',
            'amount' => 'Amount',
            'account_no' => 'Account No',
            'status' => 'Status',
        ];

        $formattedData = $rawData->map(function ($item) use ($columnMappings) {
            foreach ($columnMappings as $originalColumn => $newColumn) {
                $item[$newColumn] = $item[$originalColumn];
                unset($item[$originalColumn]);
            }

            $item['Amount'] = number_format($item['Amount'], 2);
            return $item;
        });

        $dataGenerator = function () use ($formattedData) {
            foreach ($formattedData as $data) {
                yield $data;
            }
        };

        $filename = 'ListOfCIFGuarantor-' . now()->format('d-m-Y') . '.xlsx';
        $header_style = (new Style())->setFontBold()->setShouldWrapText(false);
        $rows_style = (new Style())->setShouldWrapText(false);
        $right_style = (new Style())->setCellAlignment(CellAlignment::RIGHT);

        $data = $dataGenerator();
        $fastExcel = new FastExcel($data);

        return response()->streamDownload(function () use ($fastExcel, $header_style, $rows_style, $right_style) {
            return $fastExcel
                ->headerStyle($header_style)
                ->rowsStyle($rows_style)
                ->export('php://output');
        }, $filename);
    }

    public function new()
    {
        $this->modalName = 'Add Autopay Guarantor';
        $this->method = 'create';
        $this->generalModal = true;
    }

    public function edit($mbrNo)
    {
        $this->modalName = 'Edit Autopay Guarantor';
        $this->method = 'update';
        $this->generalModal = true;

        if($this->selectedMbr != NULL) {
            $this->selectedMbr = NULL;
        }

        $this->selectedMbr = $mbrNo;

        $data = FmsAutopayGuarantor::where('mbrno', $this->selectedMbr)->first();
        $this->mbrNo        =  $data->mbrno;
        $this->name         =  $data->name;
        $this->bank         =  $data->bank;
        $this->amount       =  $data->amount;
        $this->accountNo    =  $data->account_no;
        $this->status       =  $data->status;
    }

    #[On('customerSelected')]
    public function selectMainMember($customer)
    {
        $this->name = $customer['name'];
        $this->mbrNo = $customer['mbr_no'];
    }

    public function create()
    {
        $this->validate();
        $this->popupService->confirm($this, 'confirmCreate', 'Are you sure?', 'Do you want to create this info?');
    }

    public function confirmCreate()
    {
        FmsAutopayGuarantor::create([
            'mbrno'         => $this->mbrNo,
            'name'          => $this->name,
            'bank'          => $this->bank,
            'amount'        => $this->amount,
            'account_no'    => $this->accountNo,
            'status'        => $this->status,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        $this->generalModal = false;
        $this->dialog()->success('Success!', 'Successfully Created.');
    }

    public function update()
    {
        $this->validate();
        $this->popupService->confirm($this, 'confirmUpdate', 'Are you sure?', 'Do you want to update this info?');
    }

    public function confirmUpdate()
    {
        FmsAutopayGuarantor::where('mbrno', $this->selectedMbr)->update([
            'mbrno'         => $this->mbrNo,
            'name'          => $this->name,
            'bank'          => $this->bank,
            'amount'        => $this->amount,
            'account_no'    => $this->accountNo,
            'status'        => $this->status,
            'created_at'    => now(),
            'updated_at'    => now(),
        ]);

        $this->generalModal = false;
        $this->dialog()->success('Success!', 'Successfully Updated.');
    }

    public function delete($mbrno)
    {
        $this->popupService->confirm($this, 'confirmDelete', 'Are you sure delete the information?', 'This action cannot be reverted back', $mbrno);
    }

    public function confirmDelete($mbrno)
    {
        FmsAutopayGuarantor::where('mbrno', $mbrno)->delete();
        $this->dialog()->success('Success!', 'Successfully Deleted.');
    }

    public function render()
    {
        $data = FmsAutopayGuarantor::with('banks')->paginate(10);

        return view('livewire.teller.autopay.list-of-guarantor', [
            'data' => $data
        ]);
    }
}
