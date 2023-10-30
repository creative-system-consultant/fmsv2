<?php

namespace App\Livewire\Teller\Autopay;

use App\Models\Fms\FmsAutopayFamily;
use App\Models\Ref\RefEmployerList;
use App\Services\General\PopupService;
use App\Traits\Teller\Autopay\ListOfFamilies as AutopayListOfFamilies;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;
use WireUi\Traits\Actions;

class ListOfFamilies extends Component
{
    use Actions, WithPagination, AutopayListOfFamilies;

    public $selectedIc;

    public bool $generalModal = false;
    public $modalName;
    public $method;
    public $employer;

    #[Rule('required')]
    public $staffNoMain;

    #[Rule('required')]
    public $memberNoMain;

    #[Rule('required')]
    public $staffNo;

    #[Rule('required')]
    public $memberNo;

    #[Rule('required')]
    public $icNo;

    #[Rule('required')]
    public $code;

    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $amount;

    protected $popupService;

    public function __construct()
    {
        $this->popupService = new PopupService();
    }

    public function mount()
    {
        $this->employer = RefEmployerList::all();
    }

    public function generateExcel()
    {
        $rawData = FmsAutopayFamily::select('staff_no_main', 'memberno_main', 'staff_no', 'member_no', 'no_ic', 'code', 'name', 'amount')->get();

        $columnMappings = [
            'staff_no_main' => 'Staff No Main',
            'memberno_main' => 'Membership No Main',
            'staff_no' => 'Staff No',
            'member_no' => 'Membership No',
            'no_ic' => 'Ic No',
            'code' => 'Code',
            'name' => 'Name',
            'amount' => 'Amount',
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

        $filename = 'ListOfCIFFamilies-'. now()->format('d-m-Y') .'.xlsx';
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
        $this->modalName = 'Add Autopay Family';
        $this->method = 'create';
        $this->generalModal = true;
    }

    public function edit($ic)
    {
        $this->modalName = 'Edit Autopay Family';
        $this->method = 'update';
        $this->generalModal = true;

        if ($this->selectedIc != NULL) {
            $this->selectedIc = NULL;
        }

        $this->selectedIc = $ic;

        $data = FmsAutopayFamily::where('NO_IC', $this->selectedIc)->first();
        $this->staffNoMain  = $data->STAFF_NO_MAIN;
        $this->memberNoMain = $data->MEMBERNO_MAIN;
        $this->staffNo      = $data->STAFF_NO;
        $this->memberNo     = $data->MEMBER_NO;
        $this->icNo         = $data->NO_IC;
        $this->code         = $data->CODE;
        $this->name         = $data->NAME;
        $this->amount       = $data->AMOUNT;
    }

    #[On('customerSelected')]
    public function selectMainMember($customer)
    {
        $this->staffNoMain = $customer['staff_no'];
        $this->memberNoMain = $customer['mbr_no'];
    }

    #[On('customerSubSelected')]
    public function selectSubMember($customer)
    {
        $this->staffNo = $customer['staff_no'];
        $this->memberNo = $customer['mbr_no'];
        $this->icNo = $customer['identity_no'];
        $this->name = $customer['name'];
    }

    public function create()
    {
        $this->validate();
        $this->popupService->confirm($this, 'confirmCreate', 'Are you sure?', 'Do you want to create this info?');
    }

    public function confirmCreate()
    {
        FmsAutopayFamily::create([
            'STAFF_NO_MAIN' => $this->staffNoMain,
            'MEMBERNO_MAIN' => $this->memberNoMain,
            'STAFF_NO'      => $this->staffNo,
            'MEMBER_NO'     => $this->memberNo,
            'NO_IC'         => $this->icNo,
            'CODE'          => $this->code,
            'NAME'          => $this->name,
            'AMOUNT'        => $this->amount,
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
        FmsAutopayFamily::where('NO_IC', $this->selectedIc)->update([
            'STAFF_NO_MAIN' => $this->staffNoMain,
            'MEMBERNO_MAIN' => $this->memberNoMain,
            'STAFF_NO'      => $this->staffNo,
            'MEMBER_NO'     => $this->memberNo,
            'NO_IC'         => $this->icNo,
            'CODE'          => $this->code,
            'NAME'          => $this->name,
            'AMOUNT'        => $this->amount
        ]);

        $this->generalModal = false;
        $this->dialog()->success('Success!', 'Successfully Updated.');
    }

    public function delete($ic)
    {
        $this->popupService->confirm($this, 'ConfirmDelete', 'Are you sure delete the information?', 'This action cannot be reverted back', $ic);
    }

    public function ConfirmDelete($ic)
    {
        FmsAutopayFamily::where('NO_IC', $ic)->delete();
        $this->dialog()->success('Success!', 'Successfully Deleted.');
    }

    public function render()
    {
        $data = FmsAutopayFamily::paginate(10);

        return view('livewire.teller.autopay.list-of-families', [
            'data' => $data
        ]);
    }
}
