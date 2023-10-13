<?php

use App\Livewire\Report\Operation\List\Autopay;
use App\Livewire\Report\Operation\List\DormantMember;
use App\Livewire\Report\Operation\List\FinTrxBaseOnDisbursement;

Route::get('list/autopay', Autopay::class)->name('list.autopay');
Route::get('list/dormant-member', DormantMember::class)->name('list.dormant-member');
Route::get('list/fin-trx-base-disbursement', FinTrxBaseOnDisbursement::class)->name('list.fin-trx-base-disbursement');