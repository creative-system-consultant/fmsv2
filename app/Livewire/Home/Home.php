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
        if (session('just_logged_in') && auth()->user()->clients->count() > 1) {
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
        return $this->redirect('/home', navigate: true);
    }

    public function render()
    {
        $clientType = User::where('client_id', auth()->user()->client_id)
            ->where('user_type', 2)
            ->first();

        $data = RefBank::paginate(3);

        return view('livewire.home.home',[
            'data' => $data,
            'clients' => auth()->user()->clients,
            'clientType' => $clientType->roles->first()->name,
        ])->extends('layouts.main');
    }
}
