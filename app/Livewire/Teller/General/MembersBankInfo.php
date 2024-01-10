<?php

namespace App\Livewire\Teller\General;

use App\Services\General\PopupService;
use App\Services\Model\BankService;
use App\Services\Model\CifCustomer;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class MembersBankInfo extends Component
{
    use Actions;

    public $clientId;
    public $mbrNo;
    public $ic;
    public $refBank;

    #[Rule('required')]
    public $bankMember;

    #[Rule('required')]
    public $memberBankAccNo;

    public $icSelected = false;

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
        $this->refBank = BankService::getAllRefBanks($this->clientId);

        $cifCustAcc = CifCustomer::getCifCustomerByIc($this->ic);
        $this->bankMember = $cifCustAcc->bank_id ?? null;
        $this->memberBankAccNo = $cifCustAcc->bank_acct_no ?? '';
    }

    #[On('icSelected')]
    public function icSelected($ic)
    {
        $cifCustAcc = CifCustomer::getCifCustomerByIc($ic);
        $this->bankMember = $cifCustAcc->bank_id ?? null;
        $this->memberBankAccNo = $cifCustAcc->bank_acct_no ?? '';

        $this->ic = $ic;
        $this->icSelected = true;
    }

    public function saveMemberInfo()
    {
        $this->validate();
        PopupService::confirm($this, 'confirmSaveMemberInfo', 'Save Information?', 'Are you sure to save this information?');
    }

    public function confirmSaveMemberInfo()
    {
        $data = [
            'bank_id' => $this->bankMember,
            'bank_acct_no' => $this->memberBankAccNo
        ];

        CifCustomer::updateCifCustomer($this->ic, $data);

        $data = array('bankMember' => $this->bankMember, 'memberBankAccNo' => $this->memberBankAccNo);
        $this->dispatch('updatePayButton', $data);
        $this->dialog()->success('Updated!', 'The detail has been updated.');
    }

    public function render()
    {
        return view('livewire.teller.general.members-bank-info');
    }
}
