<?php

namespace App\Livewire\Teller\MiscellaneousOut\Category;

use App\Action\StoredProcedure\SpFmsUpTrxMiscOut;
use App\Livewire\Teller\MiscellaneousOut\MiscellaneousOutCreate;
use App\Models\Fms\FmsMiscAccount;
use App\Services\General\ActgPeriod;
use App\Services\General\PopupService;
use App\Services\Model\FmsMiscAccount as ModelFmsMiscAccount;
use Livewire\Attributes\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class Contribution extends Component
{
    use Actions;

    protected const TXN_CODE = '2220';

    public $mbrNo;
    public $startDate;
    public $endDate;
    public $miscAmt;

    #[Rule('required|lte:miscAmt|numeric')]
    public $txnAmt;

    #[Rule('required|before_or_equal:today')]
    public $txnDate;

    public $docNo = 'N/A';
    public $remarks;

    public function saveTransaction()
    {
        $this->validate();
        PopupService::confirm($this, 'confirmSaveTransaction', 'Save Transaction?', 'Are you sure to proceed with the transaction?');
    }

    public function confirmSaveTransaction()
    {
        $data = [
            'clientId' => 1,
            'mbrNo' => $this->mbrNo,
            'txnAmt' => $this->txnAmt,
            'txnDate' => $this->txnDate,
            'type' => self::TXN_CODE,
            'remarks' => $this->remarks,
            'docNo' => $this->docNo,
            'userId' => auth()->id(),
            'bankCustomer' => NULL,
            'accNo' => NULL,
            'instiCode' => NULL,
            'bankClient' => NULL
        ];

        $result = SpFmsUpTrxMiscOut::handle($data);
        $result == 'DONE'
            ? $this->dialog()->success('Success!', 'The transaction have been recorded.')
            : $this->dialog()->error('Error!', 'something went wrong.');

        $this->dispatch('refreshComponent')->to(MiscellaneousOutCreate::class);
        $this->resetFields();
    }

    private function resetFields()
    {
        $this->reset('txnAmt', 'txnDate', 'remarks');
    }

    public function render()
    {
        return view('livewire.teller.miscellaneous-out.category.contribution');
    }
}
