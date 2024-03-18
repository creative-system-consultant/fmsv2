<?php

namespace App\Livewire\Cif\Info;

use App\Action\StoredProcedure\SpUpRptPvClosedMembership;
use App\Livewire\Cif\Info\Details\Employer;
use App\Livewire\Cif\Info\Details\Information;
use App\Livewire\Cif\Info\Details\Overview;
use App\Models\Cif\CifCustomer;
use App\Services\General\PopupService;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class Details extends Component
{
    use Actions;

    public $uuid;
    public $edit = false;
    public $customerInfo;
    public $membershipInfo;
    public $clientID;
    public $ref_no;

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;
        $this->customerInfo = CifCustomer::with('fmsMembership', 'fmsMembership.introducerList')->where('uuid', $this->uuid)->where('client_id', $this->clientID)->first();
        $this->membershipInfo = $this->customerInfo->fmsMembership;
        $this->ref_no = $this->membershipInfo->mbr_no;
    }

    public function editDetail()
    {
        $this->edit = true;
        $this->dispatch('edit')->to(Overview::class);
        $this->dispatch('edit')->to(Information::class);
    }

    public function saveDetail()
    {
        PopupService::confirm($this, 'confirmSaveData', 'Save Updated Data?', 'Are you sure to proceed with the action?');
    }

    public function confirmSaveData()
    {
        $this->dispatch('save')->to(Overview::class);
        $this->dispatch('save')->to(Information::class);
        $this->edit = false;
    }

    #[On('doneSave')]
    public function showDialog()
    {
        $this->dialog()->success('Success!' , 'Data have been updated.');
    }

    public function closeMembership()
    {
        $result = SpUpRptPvClosedMembership::handle([
            'clientId' => $this->clientID,
            'mbrNo' => $this->ref_no,
            'userId' => auth()->id(),
        ]);

        if (!empty($result) && is_array($result)) {
            $data = (object) $result[0];
        } else {
            $data = new \stdClass();
        }

        $pdf = Pdf::loadView('pdf.membership_details', ['data' => $data]);
        $fileName = 'test_pdf.pdf';
        $pdf->save(storage_path($fileName));

        return response()->download(storage_path($fileName))->deleteFileAfterSend(true);
    }

    public function render()
    {
        return view('livewire.cif.info.details')->extends('layouts.main');
    }
}
