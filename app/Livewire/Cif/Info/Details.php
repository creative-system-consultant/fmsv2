<?php

namespace App\Livewire\Cif\Info;

use App\Livewire\Cif\Info\Details\Employer;
use App\Livewire\Cif\Info\Details\Information;
use App\Livewire\Cif\Info\Details\Overview;
use App\Services\General\PopupService;
use Livewire\Attributes\On;
use Livewire\Component;
use WireUi\Traits\Actions;

class Details extends Component
{
    use Actions;

    public $uuid;
    public $edit = false;

    public function editDetail()
    {
        $this->edit = true;
        $this->dispatch('edit')->to(Overview::class);
        $this->dispatch('edit')->to(Information::class);
        $this->dispatch('edit')->to(Employer::class);
    }

    public function saveDetail()
    {
        PopupService::confirm($this, 'confirmSaveData', 'Save Updated Data?', 'Are you sure to proceed with the action?');
    }

    public function confirmSaveData()
    {
        $this->dispatch('save')->to(Overview::class);
        $this->dispatch('save')->to(Information::class);
        $this->dispatch('save')->to(Employer::class);
        $this->edit = false;
    }

    #[On('doneSave')]
    public function showDialog()
    {
        $this->dialog()->success('Success!' , 'Data have been updated.');
    }

    public function render()
    {
        return view('livewire.cif.info.details')->extends('layouts.main');
    }
}
