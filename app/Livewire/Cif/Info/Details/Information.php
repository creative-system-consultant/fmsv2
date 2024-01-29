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
use App\Services\General\PopupService;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class Information extends Component
{
    public $disabled = true;
    public $customerInfo;
    public $uuid, $title_id, $name, $identity_type_id, $identity_no, $email, $email2, $phone, $resident_phone, $gender_id, $birth_date, $race_id, $bumi, $language_id, $marital_id, $country_id, $monthly_contribution, $year_tabung_khirat, $amt_tabung_khirat, $clientID;

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;
        $this->customerInfo = CifCustomer::where('uuid', $this->uuid)->where('client_id', $this->clientID)->first();
        $membershipInfo = Membership::where('cif_id', $this->customerInfo->id)->first();
        $title = RefTitle::select('description')->where('id', $this->customerInfo->title_id)->first();
        $identityType = RefIdentityType::select('description')->where('id', $this->customerInfo->identity_type_id)->first();
        $gender = RefGender::select('description')->where('id', $this->customerInfo->gender_id)->first();
        $race = RefRace::select('description')->where('id', $this->customerInfo->race_id)->first();
        // $language = RefLanguage::select('description')->where('id', $this->customerInfo->language_id)->first();
        $marital = RefMarital::select('description')->where('id', $this->customerInfo->marital_id)->first();
        $country = RefCountry::select('description')->where('id', $this->customerInfo->country_id)->first();

        $this->title_id = $title->description ?? '';
        $this->name = $this->customerInfo->name;
        $this->identity_type_id = $identityType->description ?? '';
        $this->identity_no = $this->customerInfo->identity_no;
        $this->email = $this->customerInfo->email;
        $this->email2 = $this->customerInfo->email2;
        $this->phone = $this->customerInfo->phone;
        $this->resident_phone = $this->customerInfo->resident_phone;
        $this->gender_id = $gender->description ?? '';
        $this->birth_date = $this->customerInfo->birth_date;
        $this->race_id = $race->description ?? '';
        $this->bumi = (($this->customerInfo->race_id != 6 || $this->customerInfo->race_id != 9 || $this->customerInfo->race_id != 14) ? 'Yes' : 'No');
        // $this->language_id = $language->description;
        $this->marital_id = $marital->description ?? '';
        $this->country_id = $country->description ?? '';
        $this->monthly_contribution = $membershipInfo->monthly_contribution;
        $this->year_tabung_khirat = $membershipInfo->year_tabung_khirat;
        $this->amt_tabung_khirat = $membershipInfo->amt_tabung_khirat;
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
