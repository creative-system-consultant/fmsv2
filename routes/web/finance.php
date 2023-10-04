<?php

use App\Livewire\Finance\Info;
use App\Livewire\Finance\PreDisbursement\PreDisbCreate;
use App\Livewire\Finance\Category\AccountInfo;

Route::get('financing-info', Info::class)->name('finance-financing-info');
Route::get('predisbursement-create/{id}', PreDisbCreate::class)->name('finance-predisbursement-create');
Route::get('account-info/{id}', AccountInfo::class)->name('finance-account-info');