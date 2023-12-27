<?php

namespace App\Livewire\Teller\PaymentMember\Category;

use App\Action\StoredProcedure\SpFmsUpTrxIntroducerPayment;
use App\Livewire\Teller\General\MembersBankInfo;
use App\Models\Fms\IntroducerList;
use App\Services\General\ActgPeriod;
use App\Services\General\PopupService;
use App\Services\Model\BankIbtService;
use App\Services\Model\BankService;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class Introducer extends Component
{
    use Actions;

    public $clientId;
    public $startDate;
    public $endDate;
    public $refBank;
    public $refBankIbt;
    public $txnCode;
    public $saveButton = false;

    // fetch from customer search component
    public $customer;
    public $mbrNo;
    public $introducerMbrNo;
    public $ic;

    // input
    public $bank;
    public $bankAccNo;
    public $bankClient;
    public $docNo;

    #[Rule('required')]
    public $txnAmt;

    #[Rule('required')]
    public $txnDate;
    public $remarks;

    public function mount()
    {
        $this->clientId = (int) auth()->user()->client_id;
        $this->startDate = ActgPeriod::determinePeriodRange()['startDate'];
        $this->endDate = ActgPeriod::determinePeriodRange()['endDate'];
        $this->refBank = BankService::getAllRefBanks();
        $this->refBankIbt = BankIbtService::getAllRefBankIbts();
        $this->txnCode = '6010';
    }

    public function selectIntroducer($mbrNo)
    {
        PopupService::confirm($this, 'confirmSelectIntroducer', 'Select This Account?', 'Are you sure to proceed with this account?', $mbrNo);
    }

    public function confirmSelectIntroducer($mbrNo)
    {
        $user = IntroducerList::with('customer', 'introducer')->where('mbr_no', $mbrNo)->first();

        $this->customer = $user;
        $this->bank = $user->introducer->cifCustomer->bank_id;
        $this->bankAccNo = $user->introducer->cifCustomer->bank_acct_no;
        $this->mbrNo = (string) $user->mbr_no;
        $this->introducerMbrNo = (string) $user->introducer_mbr_no;
        $this->txnAmt = 100;
        $this->saveButton = $this->bank && $this->bankAccNo;

        $this->ic = $user->customer->cifCustomer->identity_no;
        $this->dispatch('icSelected', ic: $this->ic)->to(MembersBankInfo::class);
        $this->docNo = 'N/A';
    }

    #[On('updatePayButton')]
    public function updatePayButton($data)
    {
        $this->saveButton = $data['bankMember'] && $data['memberBankAccNo'];
    }

    public function saveTransaction()
    {
        $this->validate();
        PopupService::confirm($this, 'confirmSaveTransaction', 'Save Transaction?', 'Are you sure to proceed with the transaction?');
    }

    public function confirmSaveTransaction()
    {
        $result = SpFmsUpTrxIntroducerPayment::handle([
            'clientId' => $this->clientId,
            'mbrNo' => $this->mbrNo,
            'introducerMbrNo' => $this->introducerMbrNo,
            'txnAmt' => $this->txnAmt,
            'txnDate' => $this->txnDate,
            'docNo' => $this->docNo,
            'txnCode' => $this->txnCode,
            'remarks' => $this->remarks,
            'bankMember' => $this->bank,
            'bankAccNo' => $this->bankAccNo,
            'userId' => auth()->id(),
            'bankClient' => $this->bankClient,
        ]);

        if (!$result) {
            $this->dialog()->error('Error!', 'Something went wrong.');
            return;
        }

        $message = (array) $result[0];
        $dialogType = $message["SP_RETURN_CODE"] == 0 ? 'success' : 'error';
        $messageText = $message["SP_RETURN_CODE"] == 0 ? 'Success!' : 'Error!';

        $this->dialog()->$dialogType($messageText, $message["SP_RETURN_MSG"]);

        $this->reset('txnDate');
    }

    public function render()
    {
        return view('livewire.teller.payment-member.category.introducer', [
            'lists' => IntroducerList::with('customer', 'introducer')->paginate(10)
        ]);
    }
}
