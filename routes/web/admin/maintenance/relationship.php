<?php

use App\Livewire\Admin\Maintenance\Relationship\RelationshipList;
use App\Livewire\Admin\Maintenance\Relationship\RelationshipCreate;
use App\Livewire\Admin\Maintenance\Relationship\RelationshipEdit;

Route::get('Index', RelationshipList::class)->name('list');
Route::get('RelationshipCreate', RelationshipCreate::class)->name('create');
Route::get('RelationshipEdit/{id}', RelationshipEdit::class)->name('edit');