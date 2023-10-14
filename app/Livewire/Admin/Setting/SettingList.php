<?php

namespace App\Livewire\Admin\Setting;

use Livewire\Attributes\Layout;
use Livewire\Component;

class SettingList extends Component
{
    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.admin.setting.setting-list');
    }
}
