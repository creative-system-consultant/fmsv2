<?php

use App\Livewire\Admin\Maintenance\Title\TitleCreate;
use App\Livewire\Admin\Maintenance\Title\TitleEdit;
use App\Livewire\Admin\Maintenance\Title\TitleList;

Route::get('/', TitleList::class)->name('list');
Route::get('create', TitleCreate::class)->name('create');
Route::get('edit/{id}', TitleEdit::class)->name('edit');