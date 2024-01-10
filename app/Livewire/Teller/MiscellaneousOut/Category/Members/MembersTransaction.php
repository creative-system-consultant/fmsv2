<?php

namespace App\Livewire\Teller\MiscellaneousOut\Category\Members;

use App\Action\StoredProcedure\SpFmsGenerateMbrMisc;
use App\Action\StoredProcedure\SpFmsUpTrxMiscOut;
use App\Livewire\Teller\MiscellaneousOut\MiscellaneousOutCreate;
use App\Models\Fms\FmsMiscAccount as ModelFmsMiscAccount;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Services\Model\FmsMiscAccount;
use App\Traits\Teller\General\MembersBankInfo;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class MembersTransaction extends Component
{
    use Actions, MembersBankInfo;

    protected const TXN_CODE = '2210';

    public $mbrNo;
    public $startDate;
    public $endDate;
    public $refBankIbt;
    public $miscAmt;


    #[Rule('required|lte:miscAmt|numeric')]
    public $txnAmt;

    #[Rule('required|before_or_equal:today')]
    public $txnDate;

    #[Rule('required')]
    public $docNo;

    #[Rule('required')]
    public $bankClient;
    public $remarks;

    public function mount()
    {
        $this->refBankIbt = BankIbtService::getAllRefBankIbts($this->clientId);

        $miscAcc = FmsMiscAccount::getFmsMiscAccountByMbrNo($this->mbrNo);
        ($miscAcc->misc_pv_no)
            ? $this->docNo = $miscAcc->misc_pv_no
            : $this->docNo = $this->generatePvNo($this->mbrNo);

        $cifCustomer = $miscAcc->fmsMembership->cifCustomer;
        $this->checkBankInfo($cifCustomer);
    }

    #[On('updatePayButton')]
    public function updatePayButton($data)
    {
        $this->bankMember = $data['bankMember'];
        $this->memberBankAccNo = $data['memberBankAccNo'];
        $this->membersBankDetails = $this->bankMember && $this->memberBankAccNo;
    }

    private function generatePvNo($mbrNo)
    {
        $data = [
            'clientId' => 1,
            'mbrNo' => $mbrNo
        ];

        $result = SpFmsGenerateMbrMisc::handle($data);

        if ($result) {
            return FmsMiscAccount::getFmsMiscAccountByMbrNo($this->mbrNo)->misc_pv_no;
        } else {
            return null;
        }
    }

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
        $this->reset('txnAmt', 'txnDate', 'bankClient', 'remarks');
    }

    public function render()
    {
        return view('livewire.teller.miscellaneous-out.category.members.members-transaction');
    }
}
