<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Ref\RefBank;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Home extends Component
{
    use WithPagination;
    use Actions;

    public $selectClientModal = false;

    #[Rule('required')]
    public $client;

    public function mount()
    {
        if (session('just_logged_in')) {
            $this->selectClientModal = true;
            session()->forget('just_logged_in');
        } else {
            $this->selectClientModal = false;
        }
    }

    public function saveClient()
    {
        $this->validate();

        User::whereId(auth()->id())->update(['client_id' => $this->client]);
        $this->selectClientModal = false;

        // dispatch an event
        $this->dispatch('clientUpdated');
    }

    public function render()
    {
        $data = RefBank::paginate(3);

        return view('livewire.home.home',[
            'data' => $data,
            'clients' => auth()->user()->clients
        ])->extends('layouts.main');
    }
}
