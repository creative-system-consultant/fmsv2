<?php

namespace App\Livewire\Reversal;

use App\Action\StoredProcedure\SpFmsUpTrxRvsDisburse;
use App\Models\Fms\FmsAccountStatement;
use App\Services\General\ReportService;
use App\Services\General\StoredProcedureService;
use App\Traits\Reversal\DisbursementPlaceholder;
use Carbon\Carbon;
use DB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use Throwable;
use WireUi\Traits\Actions;

class Disbursement extends Component
{
    use Actions, WithPagination, DisbursementPlaceholder;

    public $reversalModal = false;
    public $remarksModal = false;
    public $clientId;
    public $searchBy = 'FMS.ACCOUNT_STATEMENTS.account_no';
    public $search = '';

    //input declaration
    public $selectedId;
    public $name;
    public $mbrNo;
    public $accountNo;
    public $amount;
    public $trxDesc;
    public $docNo;
    public $remarks;
    public $trxDate;

    #[Rule('required|max:100')]
    public $confirmRemark;

    public function search()
    {
        $this->resetPage();
    }

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
    }

    public function reverse($id)
    {
        $this->reversalModal = true;

        $selected = FmsAccountStatement::select(
            'FMS.ACCOUNT_STATEMENTS.id',
            'CIF.CUSTOMERS.name',
            'FMS.ACCOUNT_MASTERS.mbr_no',
            'FMS.ACCOUNT_STATEMENTS.account_no',
            'FMS.ACCOUNT_STATEMENTS.amount',
            'REF.TRANSACTION_CODES.description',
            'FMS.ACCOUNT_STATEMENTS.doc_no',
            'FMS.ACCOUNT_STATEMENTS.remarks',
            'FMS.ACCOUNT_STATEMENTS.transaction_date'
        )
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_STATEMENTS.account_no', 'FMS.ACCOUNT_MASTERS.account_no')
            ->join('FMS.MEMBERSHIP', 'FMS.ACCOUNT_MASTERS.mbr_no', 'FMS.MEMBERSHIP.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id')
            ->join('REF.TRANSACTION_CODES', 'REF.TRANSACTION_CODES.id', 'FMS.ACCOUNT_STATEMENTS.transaction_code_id')
            ->where('FMS.ACCOUNT_STATEMENTS.transaction_code_id', 3610)
            ->where('FMS.ACCOUNT_STATEMENTS.client_id', $this->clientId)
            ->where('FMS.MEMBERSHIP.client_id', $this->clientId)
            ->where('FMS.ACCOUNT_MASTERS.client_id', $this->clientId)
            ->where('REF.TRANSACTION_CODES.client_id', $this->clientId)
            ->where('CIF.CUSTOMERS.client_id', $this->clientId)
            ->where('FMS.ACCOUNT_STATEMENTS.id', $id)
            ->first();

        //query to get overlap account should be here

        $this->selectedId  = $selected->id;
        $this->name        = $selected->name;
        $this->mbrNo       = $selected->mbr_no;
        $this->accountNo   = $selected->account_no;
        $this->amount      = $selected->amount;
        $this->trxDesc     = $selected->description;
        $this->docNo       = $selected->doc_no;
        $this->remarks     = $selected->remarks;
        $this->trxDate     = Carbon::create($selected->transaction_date)->format('Y-m-d');
    }

    public function confirmReverse()
    {
        $this->validate();

        $spService = new StoredProcedureService();

        $response = $spService->execute('FMS.up_trx_rvs_disburse', [
            'clientId'  => $this->clientId,
            'accountNo' => $this->accountNo,
            'trxDate'   => $this->trxDate,
            'remarks'   => $this->confirmRemark,
            'userId'    => auth()->id(),
            'idMsg'     => mt_rand(100000000, 999999999),
            'idRvs'     => $this->selectedId
        ]);

        $this->remarksModal = false;
        $this->reversalModal = false;

        if ($response['success']) {
            // Handle success, such as setting a success message or redirecting with success.
            $this->dialog()->success('Success!', 'Reversal Success.');
        } else {
            // Handle failure, such as setting an error message.
            $errorMessages = collect($response['error'])->map(function ($errorPair) {
                // Apply bold to the first element of each pair (the error code).
                $errorPair[0] = "<strong>{$errorPair[0]}</strong>";
                return implode(' - ', $errorPair);
            })->implode('<br><br>');

            // Now you can display the string of error messages
            $this->dialog()->error('DB ERROR!', $errorMessages);
        }
    }

    public function render()
    {
        // only enable this when live, for now hard coded to sept 2023 (data that has in db)
        // $start = ActgPeriod::determinePeriodRange()['startDate'];
        // $end = ActgPeriod::determinePeriodRange()['endDate'];

        $start = '2023-09-01';
        $end = '2023-09-30';

        $dataTable = FmsAccountStatement::select(
            'FMS.ACCOUNT_STATEMENTS.id',
            'CIF.CUSTOMERS.name',
            'FMS.ACCOUNT_MASTERS.mbr_no',
            'REF.TRANSACTION_CODES.trx_group',
            'FMS.ACCOUNT_STATEMENTS.account_no',
            'FMS.ACCOUNT_STATEMENTS.amount',
            'REF.TRANSACTION_CODES.description',
            'FMS.ACCOUNT_STATEMENTS.doc_no',
            'FMS.ACCOUNT_STATEMENTS.remarks',
            'FMS.ACCOUNT_STATEMENTS.transaction_date',
            'FMS.ACCOUNT_STATEMENTS.ref_id_reversal'
        )
            ->join('FMS.ACCOUNT_MASTERS', 'FMS.ACCOUNT_STATEMENTS.account_no', 'FMS.ACCOUNT_MASTERS.account_no')
            ->join('FMS.MEMBERSHIP', 'FMS.ACCOUNT_MASTERS.mbr_no', 'FMS.MEMBERSHIP.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id')
            ->join('REF.TRANSACTION_CODES', 'REF.TRANSACTION_CODES.id', 'FMS.ACCOUNT_STATEMENTS.transaction_code_id')
            ->where('FMS.ACCOUNT_STATEMENTS.transaction_code_id', 3610)
            ->where('FMS.ACCOUNT_STATEMENTS.client_id', $this->clientId)
            ->where('FMS.MEMBERSHIP.client_id', $this->clientId)
            ->where('FMS.ACCOUNT_MASTERS.client_id', $this->clientId)
            ->where('REF.TRANSACTION_CODES.client_id', $this->clientId)
            ->where('CIF.CUSTOMERS.client_id', $this->clientId)
            ->where($this->searchBy, 'LIKE', '%' . $this->search . '%')
            ->whereBetween('FMS.ACCOUNT_STATEMENTS.transaction_date', [$start, $end])
            ->orderBy('FMS.ACCOUNT_STATEMENTS.account_no', 'desc')
            ->paginate(10);

        return view('livewire.reversal.disbursement', [
            'dataTable' => $dataTable
        ])->extends('layouts.main');
    }
}
