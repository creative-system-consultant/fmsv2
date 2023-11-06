<?php

use App\Livewire\Finance\Info;
use App\Livewire\Finance\PreDisbursement\PreDisbCreate;
use App\Livewire\Finance\Category\AccountInfo;
use App\Livewire\Finance\Category\Info\AccountMaster;
use App\Livewire\Finance\Category\Info\AccountPosition;
use App\Livewire\Finance\Category\Info\EarlySettlement;
use App\Livewire\Finance\Category\Info\PreDisbCondition;
use App\Livewire\Finance\Category\Info\RepaymentSchedule;
use App\Livewire\Finance\Category\Info\Reschedule;
use App\Livewire\Finance\Category\Info\Statement;

Route::get('financing-info', Info::class)->name('finance-financing-info');
Route::get('predisbursement-create/{uuid}', PreDisbCreate::class)->name('finance-predisbursement-create');

Route::get('account-info/{uuid}', AccountInfo::class)->name('finance-account-info');
Route::get('account-master', AccountMaster::class)->name('account-master');
Route::get('account-position', AccountPosition::class)->name('account-position');
Route::get('repayment-schedule', RepaymentSchedule::class)->name('repayment-schedule');
Route::get('statements', Statement::class)->name('statements');
Route::get('pre-disbursement-conditions', PreDisbCondition::class)->name('pre-disbursement-conditions');
Route::get('early-settlement', EarlySettlement::class)->name('early-settlement');
Route::get('reschedule', Reschedule::class)->name('reschedule');
