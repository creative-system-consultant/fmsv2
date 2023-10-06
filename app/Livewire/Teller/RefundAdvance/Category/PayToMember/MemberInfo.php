<?php

namespace App\Livewire\Teller\RefundAdvance\Category\PayToMember;

use App\Services\General\PopupService;
use App\Services\Model\BankService;
use App\Services\Model\FmsAccountMaster;
use Livewire\Component;
use WireUi\Traits\Actions;

class MemberInfo extends Component
{
    use Actions;

    public $accountNo;
    public $refBank;
    public $bank;
    public $payableAccountNo;

    protected $popupService;

    public function __construct()
    {
        $this->popupService = app(PopupService::class);
    }

    public function mount($accountNo)
    {
        $this->accountNo = $accountNo;
        $this->setInitialValues();
    }

    private function setInitialValues()
    {
        $this->refBank = BankService::getAllRefBanks();
        $accountMaster = FmsAccountMaster::getAccountData($this->accountNo);
        $this->bank = $accountMaster->bank_members;
        $this->payableAccountNo = $accountMaster->account_no_members;
    }

    public function saveAdvanceInfo()
    {
        $this->validate([
            'bank' => 'required',
            'payableAccountNo' => 'required'
        ]);

        $this->popupService->confirm($this, 'confirmSaveAdvanceInfo', 'Save Information?', 'Are you sure to save this information?');
    }

    public function confirmSaveAdvanceInfo()
    {
        $data = [
            "bank_members" => $this->bank,
            "account_no_members" => $this->payableAccountNo
        ];

        FmsAccountMaster::updateAccountData($this->accountNo, $data);

        $data = array('bank' => $this->bank, 'payableAccountNo' => $this->payableAccountNo);
        $this->dispatch('updatePayButton', $data)->to(RefundAdvanceInfo::class);
        $this->dialog()->success('Updated!', 'The detail has been updated.');
    }

    public function render()
    {
        return view('livewire.teller.refund-advance.category.pay-to-member.member-info');
    }
}
