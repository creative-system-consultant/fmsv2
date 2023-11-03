<?php

namespace App\Livewire\Finance\Category\Info;

use App\Models\Cif\AccountStatuses;
use App\Models\Fms\FmsAccountMaster;
use App\Models\Ref\RefMemStatus;
use App\Models\Ref\RefPaymentType;
use Livewire\Component;
use Livewire\WithPagination;

class AccountMaster extends Component
{

    public $uuid, $payment_term, $account, $statuses, $payment_types, $custStatuses;
    public $editBtn = false;
    public $sortField = 'name';
    public $sortDirection = 'asc';
    public $search = '';
    public $search_by = 'name';

    public function edit()
    {

        $this->editBtn = true;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount()
    {

        $this->payment_term = 'm';
        $this->account = FmsAccountMaster::where('uuid', '=', $this->uuid)->first();
        $this->statuses = AccountStatuses::all();
        $this->custStatuses = RefMemStatus::all();
        $this->payment_types = RefPaymentType::all();
    }

    public function render()
    {

        return view('livewire.finance.category.info.account-master')->extends('layouts.main');
    }
}
