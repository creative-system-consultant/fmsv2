<?php

namespace App\Livewire\Finance\Category\Info;

use App\Models\Fms\FmsAccountMaster;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

class PreDisbCondition extends Component
{
    use Actions;
    use WithFileUploads;
    public $siDocument;
    public $loDocument = null;
    public $uuid;
    public $forDisplay;
    public $account;
    public $agreement_exe_date;
    public $agreement_stamp_date;
    public $offer_letter_exe_date;
    public $offer_letter_stamp_date;
    public $siCheck = false;
    public $disbSummary = false;

    public function mount()
    {
        $this->account = FmsAccountMaster::where('uuid', '=', $this->uuid)->first();
        $this->agreement_exe_date = $this->account->agreement_exe_date;
        $this->agreement_stamp_date = $this->account->agreement_stamp_date;
        $this->offer_letter_exe_date = $this->account->offer_letter_exe_date;
        $this->offer_letter_stamp_date = $this->account->offer_letter_stamp_date;
    }

    protected $rules = [
        'agreement_exe_date' => 'required|date',
        'agreement_stamp_date' => 'nullable|date',
        'offer_letter_exe_date' => 'nullable|date',
        'offer_letter_stamp_date' => 'nullable|date',
    ];

    public function siCheckBtn()
    {
        $this->siCheck =  !$this->siCheck;
    }

    public function disbSummaryBtn()
    {
        $this->disbSummary =  true;
    }

    public function removeSiDocument()
    {
        $this->siDocument = null;
    }

    public function update()
    {
        $updatedData = $this->validate([
            'agreement_exe_date' => '',
            'agreement_stamp_date' => '',
        ]);

        $this->account->update(array_merge($updatedData, [
            'pre_disbursement_flag' => 1,
            'pre_disb_user' => auth()->user()->id,
            'pre_disb_date' => now()
        ]));

        $this->account = FmsAccountMaster::where('uuid', '=', $this->uuid)->first();
        if ($this->siDocument != NULL) {

            //si
            $this->siDocument->storeAs('public/document/' . $this->account->uuid, 'SI.' . $this->siDocument->getClientOriginalExtension());
            FmsAccountMaster::updateOrCreate([
                'uuid' => $this->account->uuid,
            ], [
                'si_doc'  => 'storage/document/' . $this->account->uuid . '/' . 'SI.' . $this->siDocument->getClientOriginalExtension(),
            ]);
        }

        if ($this->loDocument != NULL) {
            //lo
            $this->loDocument->storeAs('public/lo/' . $this->account->uuid, 'lo.' . $this->loDocument->getClientOriginalExtension());
            FmsAccountMaster::updateOrCreate([
                'uuid' => $this->account->uuid,
            ], [
                'lo_doc'  => 'storage/lo/' . $this->account->uuid . '/' . 'lo.' . $this->loDocument->getClientOriginalExtension(),
            ]);
        }

        $this->dialog()->success('Success', 'Upload successfully!');
    }


    public function render()
    {

        return view('livewire.finance.category.info.pre-disb-condition');
    }
}
