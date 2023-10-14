<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Ref\RefBank;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;

class Home extends Component
{
    use WithPagination;

    #[Layout('layouts.main')]
    public function render()
    {
        $data = RefBank::paginate(3);
        return view('livewire.home.home',[
            'data' => $data
        ]);
    }
}
