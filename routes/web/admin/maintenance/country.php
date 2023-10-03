<?php

use App\Livewire\Admin\Maintenance\Country\CountryCreate;
use App\Livewire\Admin\Maintenance\Country\CountryEdit;
use App\Livewire\Admin\Maintenance\Country\CountryList;

Route::get('/',CountryList::class)->name('list');
Route::get('create',CountryCreate::class)->name('create');
Route::get('edit/{id}',CountryEdit::class)->name('edit');