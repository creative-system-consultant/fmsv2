<?php

use App\Livewire\Admin\Maintenance\Race\RaceCreate;
use App\Livewire\Admin\Maintenance\Race\RaceEdit;
use App\Livewire\Admin\Maintenance\Race\RaceList;

Route::get('list', RaceList::class)->name('list');
Route::get('create', RaceCreate::class)->name('create');
Route::get('edit/{id}', RaceEdit::class)->name('edit');