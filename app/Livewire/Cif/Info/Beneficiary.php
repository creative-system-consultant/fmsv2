<?php

namespace App\Livewire\Cif\Info;

use App\Models\Cif\CifCustomer;
use App\Models\Cif\Family;
use App\Models\Ref\RefIdentityType;
use App\Models\Ref\RefRace;
use App\Models\Ref\RefRelationship;
use App\Models\Ref\RefReligion;
use App\Services\General\PopupService;
use Livewire\Component;
use WireUi\Traits\Actions;

class Beneficiary extends Component
{
    use Actions;

    public $customer, $uuid, $families, $identity_types, $races, $religions, $relations;
    public $edit = false;
    public $disabled = true;

    protected $rules = [
        'families.*.name'                       => '',
        'families.*.identity_type_id'           => '',
        'families.*.identity_no'                => '',
        'families.*.race_id'                    => '',
        'families.*.religion_id'                => '',
        'families.*.relation_id'                => '',
        'families.*.nominee_flag'               => '',
        'families.*.nominee_share'              => '',
        'families.*.phone_no'                   => '',
        'families.*.employer_name'              => '',
        'families.*.work_post'                  => '',
        'families.*.salary'                     => '',
    ];

    public function mount()
    {
        $clientID = auth()->user()->client_id;
        $customer = CifCustomer::where('uuid', $this->uuid)->where('client_id', $clientID)->first();

        $this->families                 = ($customer->families) ? $customer->families->toArray() : 0;
        $this->identity_types           = RefIdentityType::all();
        $this->races                    = RefRace::all();
        $this->religions                = RefReligion::all();
        $this->relations                = RefRelationship::all();
    }

    public function editBeneficiary()
    {
        $this->edit = true;
        $this->disabled = false;
    }

    public function saveBeneficiary()
    {
        PopupService::confirm($this, 'confirmSaveData', 'Save Updated Data?', 'Are you sure to proceed with the action?');
    }

    public function confirmSaveData()
    {
        $this->edit = false;
        $this->disabled = true;

        foreach ($this->families as $family) {
            Family::where('id', $family['id'])->update([
                'name'              => $family['name'],
                'identity_type_id'  => $family['identity_type_id'],
                'identity_no'       => $family['identity_no'],
                'race_id'           => $family['race_id'],
                'religion_id'       => $family['religion_id'],
                'relation_id'       => $family['relation_id'],
                'nominee_flag'      => $family['nominee_flag'] == true ? 1 : NULL,
                'nominee_share'     => $family['nominee_share'],
                'phone_no'          => $family['phone_no'],
                'employer_name'     => $family['employer_name'],
                'work_post'         => $family['work_post'],
                'salary'            => $family['salary'],
                'updated_by'        => auth()->user()->id,
                'updated_at'        => now(),
            ]);
        }

        $this->dialog()->success('Success!' , 'Data have been updated.');
    }

    public function newFamily()
    {
        $newFamily = [[
            'id'                => NULL,
            'customer_id'       => $this->customer->id,
            'name'              => NULL,
            'identity_type_id'  => NULL,
            'identity_no'       => NULL,
            'race_id'           => NULL,
            'religion_id'       => NULL,
            'relation_id'       => NULL,
            'nominee_flag'      => NULL,
            'nominee_share'     => NULL,
            'phone_no'          => NULL,
            'employer_name'     => NULL,
            'work_post'         => NULL,
            'salary'            => NULL,
            'created_by'        => auth()->user()->id,
            'updated_by'        => NULL,
            'deleted_by'        => NULL,
            'created_at'        => NULL,
            'updated_at'        => NULL,
            'deleted_at'        => NULL,
        ]];
        $this->families = array_merge($this->families, $newFamily);
    }

    public function deleteFamily($key)
    {
        $id = $this->families[$key]['id'];
        $family = $this->customer->families->where('id', $id)->first();
        if (isset($family)) {
            $family->update(['deleted_by' => auth()->user()->id]);
            $family->delete();
        }
        unset($this->families[$key]);
    }

    public function saveFamily()
    {
        if (array_sum(array_column($this->families, 'nominee_flag')) == 1) {
            foreach ($this->families as $index => $family) {
                if (isset($family['id'])) {
                    Family::where('id', $family['id'])->update([
                        // 'id'                => $family['id'],
                        'customer_id'       => $family['customer_id'],
                        'name'              => $family['name'],
                        'identity_type_id'  => $family['identity_type_id'],
                        'identity_no'       => $family['identity_no'],
                        'race_id'           => $family['race_id'],
                        'religion_id'       => $family['religion_id'],
                        'relation_id'       => $family['relation_id'],
                        'nominee_flag'      => $family['nominee_flag'] == true ? '1' : NULL,
                        'nominee_share'     => $family['nominee_share'],
                        'phone_no'          => $family['phone_no'],
                        'employer_name'     => $family['employer_name'],
                        'work_post'          => $family['work_post'],
                        'salary'            => $family['salary'],
                        'updated_by'        => auth()->user()->id,
                        'updated_at'        => date("Y-m-d h:i:sa"),
                    ]);
                } else {
                    Family::create([
                        // 'id'             => $family['id'],
                        'customer_id'       => $family['customer_id'],
                        'name'              => $family['name'],
                        'identity_type_id'  => $family['identity_type_id'],
                        'identity_no'       => $family['identity_no'],
                        'race_id'           => $family['race_id'],
                        'religion_id'       => $family['religion_id'],
                        'relation_id'       => $family['relation_id'],
                        'nominee_flag'      => $family['nominee_flag'] == true ? '1' : NULL,
                        'nominee_share'     => $family['nominee_share'],
                        'phone_no'          => $family['phone_no'],
                        'employer_name'     => $family['employer_name'],
                        'work_post'         => $family['work_post'],
                        'salary'            => $family['salary'],
                        'created_by'        => $family['created_by'],
                        'updated_by'        => auth()->user()->id,
                        'updated_at'        => date("Y-m-d h:i:sa"),
                        'institute_id'      => auth()->user()->group->institute_id,
                    ]);
                }
            }

            $this->mount();
            $this->render();
        }
        return redirect()->to('/cif/individual/' . $this->customer->uuid);
    }

    public function render()
    {
        return view('livewire.cif.info.beneficiary')->extends('layouts.main');
    }
}
