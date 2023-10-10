<?php

namespace App\Livewire\Teller\RefundAdvance\Category\PayToMember;

use App\Services\General\PopupService;
use App\Services\Model\BankService;
use App\Services\Model\CifCustomer;
use App\Services\Model\FmsAccountMaster;
use Livewire\Attributes\Rule;
use Livewire\Component;
use WireUi\Traits\Actions;

class MemberInfo extends Component
{
    use Actions;  // Traits to enable UI actions

    // Component's public properties.
    public $accountNo;          // The account number associated with the member
    public $refBank;            // List of reference banks
    public $ic;                 // The identification number (or IC number)

    // Properties with validation rules using PHP 8's attribute syntax
    #[Rule('required')]
    public $bank;               // The bank ID associated with the member

    #[Rule('required')]
    public $payableAccountNo;   // The account number where payment is to be made

    /**
     * Initialize the component with given account number.
     *
     * @param string $accountNo The account number to initialize with.
     */
    public function mount($accountNo)
    {
        $this->accountNo = $accountNo;
        $this->setInitialValues();
    }

    /**
     * Sets initial values for the component using the given account number.
     */
    private function setInitialValues()
    {
        // Fetch reference banks list
        $this->refBank = BankService::getAllRefBanks();

        // Retrieve account data based on the given account number
        $accountMaster = FmsAccountMaster::getAccountData($this->accountNo);

        // Set member's details based on retrieved account data
        $this->ic = $accountMaster->cifCustomer->identity_no;
        $this->bank = $accountMaster->cifCustomer->bank_id;
        $this->payableAccountNo = $accountMaster->cifCustomer->bank_acct_no;
    }

    /**
     * Handles the process to save advance payment information.
     */
    public function saveAdvanceInfo()
    {
        // Validates the properties with defined validation rules
        $this->validate();

        // Triggers a confirmation popup before committing changes
        PopupService::confirm($this, 'confirmSaveAdvanceInfo', 'Save Information?', 'Are you sure to save this information?');
    }

    /**
     * Commits changes to the database after user confirmation.
     */
    public function confirmSaveAdvanceInfo()
    {
        $data = [
            'bank_id' => $this->bank,
            'bank_acct_no' => $this->payableAccountNo
        ];

        // Updates CIF Customer data in the database
        CifCustomer::updateCifCustomer($this->ic, $data);

        $data = array('bank' => $this->bank, 'payableAccountNo' => $this->payableAccountNo);

        // Sends an update event to another Livewire component (RefundAdvanceInfo)
        $this->dispatch('updatePayButton', $data)->to(RefundAdvanceInfo::class);

        // Displays a success message to the user
        $this->dialog()->success('Updated!', 'The detail has been updated.');
    }

    /**
     * Renders the component's view.
     *
     * @return \Illuminate\View\View The view of the component.
     */
    public function render()
    {
        return view('livewire.teller.refund-advance.category.pay-to-member.member-info');
    }
}
