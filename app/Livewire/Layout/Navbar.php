<?php

namespace App\Livewire\Layout;

use App\Livewire\Home\Home;
use App\Models\User;
use Livewire\Component;

class Navbar extends Component
{
    public function selectClient($id)
    {
        User::whereId(auth()->id())->update(['client_id' => $id]);
        // dispatch an event
        $this->dispatch('clientUpdated');

        return $this->redirect(Home::class);
    }

    public function render()
    {
        return view('livewire.layout.navbar');
    }
}
