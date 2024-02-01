<?php

namespace App\Livewire\Profile;

use App\Models\User;
use App\Traits\ImageIntervention;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use WireUi\Traits\Actions;

use function Laravel\Prompts\password;

class Index extends Component
{
    use Actions, WithFileUploads, ImageIntervention;

    #[Rule('nullable|file|mimes:jpg,png')]
    public $profile_picture;

    #[Rule('required')]
    public $email;

    #[Rule('nullable|string|min:8|confirmed')]
    public $password;

    public $password_confirmation;

    protected $listeners = ['refresh' => '$refresh'];

    public function mount()
    {
        $this->email = auth()->user()->email;
    }

    public function submit()
    {
        $this->validate();

        if ($this->profile_picture) {
            $path = $this->createThumbnail($this->profile_picture, auth()->user()->uuid, 'Users');

            User::whereId(auth()->id())->update([
                'profile_photo_path' => $path,
            ]);
        }

        if (!empty($this->password)) {
            User::whereId(auth()->id())->update([
                'password' => Hash::make($this->password),
            ]);

            $this->notification()->success(
                $title = 'Success!',
                $description = 'Password Changed Successfully.'
            );

            $this->reset('password', 'password_confirmation');
        }

        $this->dispatch('pondReset');
        $this->dispatch('refresh')->self();
    }

    public function render()
    {
        return view('livewire.profile.index')->extends('layouts.main');
    }
}
