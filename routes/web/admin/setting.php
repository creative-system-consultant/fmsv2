<?php

use App\Livewire\Admin\Setting\SettingList;


Route::get('setting-list', SettingList::class)->name('setting-list');

//admin/maintenance
Route::prefix('maintenance')->as('maintenance.')->group(
    base_path('routes/web/admin/maintenance.php'),
);