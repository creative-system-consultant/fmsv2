<?php

use App\Livewire\Admin\Maintenance\Education\EducationCreate;
use App\Livewire\admin\Maintenance\Education\EducationEdit;
use App\Livewire\admin\Maintenance\Education\EducationList;

Route::get('/',EducationList::class)->name('list');
Route::get('create',EducationCreate::class)->name('create');
Route::get('edit/{id}',EducationEdit::class)->name('edit');