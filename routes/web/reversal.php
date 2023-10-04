<?php

use App\Livewire\Reversal\ReversalList;
use App\Livewire\Reversal\Contribution;
use App\Livewire\Reversal\Disbursement;
use App\Livewire\Reversal\Dividend;
use App\Livewire\Reversal\EarlySettlement;
use App\Livewire\Reversal\FinancingRepayment;
use App\Livewire\Reversal\Miscellaneous;
use App\Livewire\Reversal\OtherPayment;
use App\Livewire\Reversal\RefundAdvance;
use App\Livewire\Reversal\Share;
use App\Livewire\Reversal\ThirdParty;



Route::get('reversal-list', ReversalList::class)->name('reversal-list');
Route::get('contribution', Contribution::class)->name('reversal-contribution');
Route::get('disbursement', Disbursement::class)->name('reversal-disbursement');
Route::get('dividend', Dividend::class)->name('reversal-dividend');
Route::get('early-settlement', EarlySettlement::class)->name('reversal-early-settlement');
Route::get('financing-repayment', FinancingRepayment::class)->name('reversal-financing-repayment');
Route::get('miscellaneous', Miscellaneous::class)->name('reversal-miscellaneous');
Route::get('other-payment', OtherPayment::class)->name('reversal-other-payment');
Route::get('refund-advance', RefundAdvance::class)->name('reversal-refund-advance');
Route::get('share', Share::class)->name('reversal-share');
Route::get('third-party', ThirdParty::class)->name('reversal-third-party');
