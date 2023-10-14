<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Cif\Employer;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Details extends Component
{
    public $uuid, $employer;
    public $cName, $cAddress, $cFax_num, $cOffice_num, $cDepartment, $cJob_status, $cPosition, $cEmployment_date, $cSalary; //company form

    public $staffNo, $membershipNo, $name, $identityNumber, $category, $type, $status, $applyDate, $joinDate, $startDate, //customer form
        $statusChangedDate, $approvedRetirementDate, $effectiveRetirementDate, $entranceFee, $entranceFeeDate, $introducerName,
        $introducerMembershipID, $introducerIC, $bank, $bankAccountNo, $paymentType, $payerStaffNo, $virtualAccount;

    public $email, $mobileNo, $monthlyContribution;

    public $editDetail = false;

    public function mount()
    {
        $CustomerInfo = CifCustomer::where('uuid', $this->uuid)->first();
        // dd($CustomerInfo);
        if ($CustomerInfo) {

            $this->name = $CustomerInfo->name;
            $this->identityNumber = $CustomerInfo->icno;
            $this->mobileNo = $CustomerInfo->mobile_num;
            $this->email = $CustomerInfo->email;
            $this->monthlyContribution = number_format($CustomerInfo->contribution_monthly, 2);
            $this->status = ($CustomerInfo->cust_status == 'Y' ? 'Active' : 'Closed');
            // $this->birthdate = $CustomerInfo->birthdate;
            // $this->birthplace = $CustomerInfo->birthplace;
            // $this->gender_id = $CustomerInfo->gender_id;
            // $this->marital_id = $CustomerInfo->marital_id;
            // $this->race_id = $CustomerInfo->race_id;
            // $this->language_id = $CustomerInfo->language_id;
            // $this->country_id = $CustomerInfo->country_id;
            // $this->education_id = $CustomerInfo->education_id;
            // $this->status_id = $CustomerInfo->status_id;
            // $this->cust_status = $CustomerInfo->cust_status;
            // $this->share = $CustomerInfo->share;
            // $this->contribution = $CustomerInfo->contribution;


            $this->employer = Employer::where('cust_id', $CustomerInfo->id)->first();
            if ($this->employer) {
                $this->cName = $this->employer->name;
                $this->cAddress = $this->employer->address_id;
                $this->cFax_num = $this->employer->office_num;
                $this->cOffice_num = $this->employer->office_num;
                $this->cDepartment = $this->employer->department;
                $this->cJob_status = 1;
                $this->cPosition = $this->employer->position;
                $this->cEmployment_date = $this->employer->created_at;
                $this->cSalary = $this->employer->salary;
            }
        } else {
            // redirect(route('home'));
        }
    }
    function editDetail()
    {
        $this->editDetail = true;
    }

    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.cif.info.details');
    }
}
