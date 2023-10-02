<?php

use App\Livewire\Admin\Maintenance\Marital\MaritalCreate;
use App\Livewire\Admin\Maintenance\Marital\MaritalEdit;
use App\Livewire\Admin\Maintenance\Marital\MaritalList;

Route::get('/', MaritalList::class)->name('list');
Route::get('create', MaritalCreate::class)->name('create');
Route::get('edit/{id}', MaritalEdit::class)->name('edit');