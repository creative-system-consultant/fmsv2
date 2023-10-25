<?php

use App\Livewire\Admin\Maintenance\State;
use App\Livewire\Admin\Maintenance\Glcode;
use App\Livewire\Admin\Maintenance\Gender;
use App\Livewire\Admin\Maintenance\Race;
use App\Livewire\Admin\Maintenance\Relationship;
use App\Livewire\Admin\Maintenance\Religion;
use App\Livewire\Admin\Maintenance\Title;
use App\Livewire\Admin\Maintenance\Bank;
use App\Livewire\Admin\Maintenance\Education;
use App\Livewire\Admin\Maintenance\Country;
use App\Livewire\Admin\Maintenance\Marital;
use App\Livewire\Admin\Maintenance\FinancingRule;

Route::get('state', State::class)->name('state');
Route::get('glcode', Glcode::class)->name('glcode');
Route::get('gender', Gender::class)->name('gender');
Route::get('race', Race::class)->name('race');
Route::get('relationship', Relationship::class)->name('relationship');
Route::get('religion', Religion::class)->name('religion');
Route::get('title', Title::class)->name('title');
Route::get('bank', Bank::class)->name('bank');
Route::get('education', Education::class)->name('education');
Route::get('country', Country::class)->name('country');
Route::get('marital', Marital::class)->name('marital');
Route::get('financing-rule', FinancingRule::class)->name('financing-rule');
