<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Ref\RefBank;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    public function render()
    {
        $data = RefBank::paginate(3);
        return view('livewire.home.home',[
            'data' => $data
        ])->extends('layouts.main');
    }
}
