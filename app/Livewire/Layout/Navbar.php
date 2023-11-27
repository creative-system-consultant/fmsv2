<?php

namespace App\Livewire\Layout;

use App\Livewire\Home\Home;
use App\Models\User;
use Livewire\Component;

class Navbar extends Component
{
    public $color = [
        ['bg-slate-600', 'Slate'],
        ['bg-gray-600', 'Gray'],
        ['bg-zinc-600', 'Zinc'],
        ['bg-neutral-600', 'Neutral'],
        ['bg-stone-600', 'Stone'],
        ['bg-red-600', 'Red'],
        ['bg-orange-600', 'Orange'],
        ['bg-amber-600', 'Amber'],
        ['bg-yellow-600', 'Yellow'],
        ['bg-lime-600', 'Lime'],
        ['bg-green-600', 'Green'],
        ['bg-emerald-600', 'Emerald'],
        ['bg-teal-600', 'Teal'],
        ['bg-cyan-600', 'Cyan'],
        ['bg-sky-600', 'Sky'],
        ['bg-blue-600', 'Blue'],
        ['bg-indigo-600', 'Indigo'],
        ['bg-violet-600', 'Violet'],
        ['bg-purple-600', 'Purple'],
        ['bg-fuchsia-600', 'Fuchsia'],
        ['bg-pink-600', 'Pink'],
        ['bg-rose-600', 'Rose']
    ];

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
