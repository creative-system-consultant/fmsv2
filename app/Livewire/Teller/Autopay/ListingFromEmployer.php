<?php

namespace App\Livewire\Teller\Autopay;

use App\Action\StoredProcedure\SpFmsUploadAutopayFromEmployer;
use App\Models\Fms\FmsAutopayRefCode;
use App\Models\FMS\FmsAutopayUploadFromEmployer;
use App\Services\General\ActgPeriod;
use DB;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Rap2hpoutre\FastExcel\FastExcel;
use WireUi\Traits\Actions;

class ListingFromEmployer extends Component
{
    use Actions, WithFileUploads;

    public $clientId;
    public $startDate;
    public $endDate;
    public $employers;
    public $today;

    // #[Rule('required|gte:today')]
    #[Rule('required')]
    public $txnDate;

    #[Rule('required')]
    public $employerId;

    public $docNo;

    #[Rule('file|max:3072|mimes:xlsx')]
    public $dokumen;

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
        $this->today = now()->format('Y-m-d');
        $this->startDate = ActgPeriod::determinePeriodRange()['startDate'];
        $this->endDate = ActgPeriod::determinePeriodRange()['endDate'];
        $this->employers = FmsAutopayRefCode::all();
    }

    public function clearFile()
    {
        $this->dokumen = NULL;
    }

    public function uploadExcel()
    {
        $this->validate();

        $uploadDirectory = 'teller/autopay/uploads';
        $fileName = uniqid() . '.' . $this->dokumen->getClientOriginalExtension();
        $this->dokumen->storeAs($uploadDirectory, $fileName, 'public');
        $filePath = storage_path('app/public/' . $uploadDirectory . '/' . $fileName);

        // Import the file using FastExcel
        $dataUploaded = (new FastExcel())->import($filePath);
        unlink($filePath); // Remove the file from storage

        if(count($dataUploaded) > 0) {
            FmsAutopayUploadFromEmployer::truncate();

            foreach ($dataUploaded as $customer) {
                FmsAutopayUploadFromEmployer::create([
                    'CLIENT_ID' => $this->clientId,
                    'MBRNO' => $customer['MBRNO'],
                    'NAME' => $customer['NAME'],
                    'NRIC' => $customer['NRIC'],
                    'ADCODE' => $customer['ADCODE'],
                    'AMOUNT' => $customer['AMOUNT']
                ]);
            }

            SpFmsUploadAutopayFromEmployer::handle([
                'clientId' => $this->clientId,
                'txnDate' => $this->txnDate,
                'code' => $this->employerId
            ]);

            $this->dialog()->success('Success!', 'Currently Processing.');
            $this->reset('txnDate', 'employerId', 'docNo', 'dokumen');
        } else {
            $this->dialog()->info('Info!', 'No Data Uploaded.');
        }
    }

    public function render()
    {
        return view('livewire.teller.autopay.listing-from-employer');
    }
}
