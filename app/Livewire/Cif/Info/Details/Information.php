<?php

namespace App\Livewire\Cif\Info\Details;

use App\Livewire\Cif\Info\Details;
use App\Models\Cif\CifCustomer;
use App\Models\Fms\Membership;
use App\Models\Ref\RefCountry;
use App\Models\Ref\RefGender;
use App\Models\Ref\RefIdentityType;
use App\Models\Ref\RefLanguage;
use App\Models\Ref\RefMarital;
use App\Models\Ref\RefRace;
use App\Models\Ref\RefTitle;
use App\Models\Ref\RefBank;
use App\Models\Ref\RefEducation;
use App\Models\Ref\RefReligion;
use App\Services\General\PopupService;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class Information extends Component
{
    public $disabled = true;
    public $customerInfo;
    public $uuid, $title_id, $name, $identity_type_id, $identity_no, $email, $email2, $phone, $resident_phone, $gender_id, $birth_date, $race_id, $religion, $education, $bumi, $language_id, $marital_id, $country_id, $monthly_contribution, $year_tabung_khairat, $amt_tabung_khairat, $bank_id, $bank_acct_no, $va_account, $clientID;
    public $banks;
    public $bankOptions = [];

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;
        $this->customerInfo = CifCustomer::where('uuid', $this->uuid)->where('client_id', $this->clientID)->first();
        $membershipInfo = Membership::where('cif_id', $this->customerInfo->id)->first();
        $title = RefTitle::select('description')->where('id', $this->customerInfo->title_id)->first();
        $identityType = RefIdentityType::select('description')->where('id', $this->customerInfo->identity_type_id)->first();
        $gender = RefGender::select('description')->where('code', $this->customerInfo->gender_code)->first();
        $race = RefRace::select('description')->where('id', $this->customerInfo->race_id)->first();
        $religion = RefReligion::select('description')->where('id', $this->customerInfo->religion_id)->first();
        $education = RefEducation::select('description')->where('id', $this->customerInfo->education_id)->first();
        // $language = RefLanguage::select('description')->where('id', $this->customerInfo->language_id)->first();
        $marital = RefMarital::select('description')->where('id', $this->customerInfo->marital_id)->first();
        $country = RefCountry::select('description')->where('id', $this->customerInfo->country_id)->first();

        // Transform banks data to match the select options format
        $this->banks = RefBank::where('client_id', $this->clientID)->get();
        $this->bankOptions = $this->banks->map(function ($bank) {
            return ['name' => $bank->description, 'id' => $bank->id];
        })->toArray();

        $this->title_id = $title->description ?? '';
        $this->name = $this->customerInfo->name;
        $this->identity_type_id = $identityType->description ?? '';
        $this->identity_no = $this->customerInfo->identity_no;
        $this->email = $this->customerInfo->email;
        $this->phone = $this->customerInfo->phone;
        $this->resident_phone = $this->customerInfo->resident_phone;
        $this->gender_id = $gender->description ?? '';
        $this->birth_date = Carbon::parse($this->customerInfo->birth_date)->format('d-m-Y');
        $this->race_id = $race->description ?? '';
        $this->religion = $religion->description ?? '';
        $this->education = $education->description ?? '';
        $this->bumi = (($this->customerInfo->race_id != 6 || $this->customerInfo->race_id != 9 || $this->customerInfo->race_id != 14) ? 'Yes' : 'No');
        $this->marital_id = $marital->description ?? '';
        $this->country_id = $country->description ?? '';
        $this->bank_id = $this->customerInfo->bank_id;
        $this->bank_acct_no = $this->customerInfo->bank_acct_no;
    }

    #[On('edit')]
    public function editData()
    {
        $this->disabled = false;
    }

    #[On('save')]
    public function saveData()
    {
        $this->customerInfo->update([
            'resident_phone' => $this->resident_phone
        ]);

        $this->disabled = true;
    }

    public function render()
    {
        return view('livewire.cif.info.details.information');
    }
}
