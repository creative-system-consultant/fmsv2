<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Attributes\Layout;
use Livewire\Component;

class SettingList extends Component
{
    public function render()
    {
        $settingMaintenance = collect(config('module.setting.maintenance.index'))->groupBy('group');
        return view('livewire.admin.setting.setting-list',[
            "settingMaintenance" => $settingMaintenance
        ])->extends('layouts.main');
    }
}
