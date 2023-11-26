<?php

use App\Livewire\Cif\Individual;
use App\Livewire\Cif\Info;
use App\Livewire\Cif\Info\ThirdPartyInfo;
use App\Livewire\Cif\Info\Guarantee;
use App\Livewire\Cif\Info\OthersPayment;
use App\Livewire\Cif\Info\Details;
use App\Livewire\Cif\Info\Address;
use App\Livewire\Cif\Info\Beneficiary;
use App\Livewire\Cif\Info\Contribution;
use App\Livewire\Cif\Info\Share;
use App\Livewire\Cif\Info\Finance;
use App\Livewire\Cif\Membership;

Route::get('main', Individual::class)->name('main');
Route::get('info/{uuid}', Info::class)->name('info');
Route::get('details', Details::class)->name('details');
Route::get('address', Address::class)->name('address');
Route::get('beneficiary', Beneficiary::class)->name('beneficiary');
Route::get('third-party', ThirdPartyInfo::class)->name('third-party-info');
Route::get('others-payment', OthersPayment::class)->name('others-payment');
Route::get('guarantee', Guarantee::class)->name('guarantee');
Route::get('contribution', Contribution::class)->name('contribution');
Route::get('share', Share::class)->name('share');
Route::get('finance', Finance::class)->name('finance');
Route::get('member/{uuid}', Membership::class)->name('member');
