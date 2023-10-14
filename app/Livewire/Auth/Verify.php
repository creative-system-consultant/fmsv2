<?php

namespace App\Livewire\Auth;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Verify extends Component
{
    public function resend()
    {
        if (Auth::user()->hasVerifiedEmail()) {
            redirect(route('home'));
        }

        Auth::user()->sendEmailVerificationNotification();

        $this->emit('resent');

        session()->flash('resent');
    }

    #[Layout('layouts.auth')]
    public function render()
    {
        return view('livewire.auth.verify');
    }
}
