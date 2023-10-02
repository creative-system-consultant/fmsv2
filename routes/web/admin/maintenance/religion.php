<?php

use App\Livewire\Admin\Maintenance\Religion\ReligionCreate;
use App\Livewire\Admin\Maintenance\Religion\ReligionEdit;
use App\Livewire\Admin\Maintenance\Religion\ReligionList;

Route::get('/', ReligionList::class)->name('list');
Route::get('ReligionCreate', ReligionCreate::class)->name('create');
Route::get('ReligionEdit/{id}', ReligionEdit::class)->name('edit');