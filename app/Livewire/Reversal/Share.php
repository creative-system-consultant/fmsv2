<?php

namespace App\Livewire\Reversal;

use App\Models\Fms\FmsMembershipStatement;
use App\Services\General\ActgPeriod;
use App\Services\General\ReportService;
use App\Services\General\StoredProcedureService;
use App\Traits\Reversal\SharePlaceholder;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Share extends Component
{
    use Actions, WithPagination, SharePlaceholder;

    public $reversalModal = false;
    public $remarksModal = false;
    public $clientId;
    public $searchBy = 'FMS.MEMBERSHIP_STATEMENTS.mbr_no';
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
    public $trxCode;
    public $share;

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

        $selected = FmsMembershipStatement::select(
            'FMS.MEMBERSHIP_STATEMENTS.id',
            'FMS.MEMBERSHIP_STATEMENTS.doc_no',
            'CIF.CUSTOMERS.name',
            'REF.TRANSACTION_CODES.description',
            'FMS.MEMBERSHIP_STATEMENTS.mbr_no',
            'FMS.MEMBERSHIP_STATEMENTS.transaction_date',
            'FMS.MEMBERSHIP_STATEMENTS.amount',
            'REF.TRANSACTION_CODES.trx_group',
            'FMS.MEMBERSHIP_STATEMENTS.ref_id_reversal',
            'FMS.MEMBERSHIP_STATEMENTS.transaction_code_id',
            'FMS.MEMBERSHIP.total_share'
        )
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP_STATEMENTS.mbr_no', 'FMS.MEMBERSHIP.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id')
            ->join('REF.TRANSACTION_CODES', 'REF.TRANSACTION_CODES.id', 'FMS.MEMBERSHIP_STATEMENTS.transaction_code_id')
            ->where('FMS.MEMBERSHIP_STATEMENTS.id', $id)
            ->first();

        $this->selectedId  = $selected->id;
        $this->name        = $selected->name;
        $this->mbrNo       = $selected->mbr_no;
        $this->amount      = $selected->amount;
        $this->trxDesc     = $selected->description;
        $this->docNo       = $selected->doc_no;
        $this->trxDate     = Carbon::create($selected->transaction_date)->format('Y-m-d');
        $this->trxCode     = $selected->transaction_code_id;
        $this->share       = $selected->total_share;
    }

    public function confirmReverse()
    {
        $this->validate();

        $spService = new StoredProcedureService();

        $response = $spService->execute('FMS.up_trx_rvs_shares', [
            'clientId'  => $this->clientId,
            'mbrNo'  => $this->mbrNo,
            'amount'   => $this->amount,
            'trxDate'   => $this->trxDate,
            'remarks'   => $this->confirmRemark,
            'userId'    => auth()->id(),
            'trxCode'   => $this->trxCode,
            'idRvs'     => $this->selectedId,
            'idMsg'     => mt_rand(100000000, 999999999)
        ]);

        $this->remarksModal = false;
        $this->reversalModal = false;
        $this->reset('confirmRemark');

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

        $dataTable = FmsMembershipStatement::select(
            'FMS.MEMBERSHIP_STATEMENTS.id',
            'FMS.MEMBERSHIP_STATEMENTS.doc_no',
            'CIF.CUSTOMERS.name',
            'REF.TRANSACTION_CODES.description',
            'FMS.MEMBERSHIP_STATEMENTS.mbr_no',
            'FMS.MEMBERSHIP_STATEMENTS.transaction_date',
            'FMS.MEMBERSHIP_STATEMENTS.amount',
            'REF.TRANSACTION_CODES.trx_group',
            'FMS.MEMBERSHIP_STATEMENTS.ref_id_reversal'
        )
            ->join('FMS.MEMBERSHIP', 'FMS.MEMBERSHIP_STATEMENTS.mbr_no', 'FMS.MEMBERSHIP.mbr_no')
            ->join('CIF.CUSTOMERS', 'CIF.CUSTOMERS.id', 'FMS.MEMBERSHIP.cif_id')
            ->join('REF.TRANSACTION_CODES', 'REF.TRANSACTION_CODES.id', 'FMS.MEMBERSHIP_STATEMENTS.transaction_code_id')
            ->whereIn('REF.TRANSACTION_CODES.trx_group', ['SHARES', 'SHARES - Balance C/F', 'SHARES (REVERSAL)'])
            ->whereBetween('FMS.MEMBERSHIP_STATEMENTS.transaction_date', [$start, $end])
            ->where('FMS.MEMBERSHIP_STATEMENTS.client_id', $this->clientId)
            ->where('FMS.MEMBERSHIP.client_id', $this->clientId)
            ->where('CIF.CUSTOMERS.client_id', $this->clientId)
            ->where('REF.TRANSACTION_CODES.client_id', $this->clientId)
            ->where($this->searchBy, 'LIKE', '%' . $this->search . '%')
            ->orderBy('FMS.MEMBERSHIP_STATEMENTS.id', 'desc')
            ->paginate(10);

        return view('livewire.reversal.share', [
            'dataTable' => $dataTable
        ])->extends('layouts.main');
    }
}
