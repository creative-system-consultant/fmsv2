<?php

namespace App\Livewire\Dividen;

use Livewire\Attributes\Layout;
use Livewire\Component;

class DividenIndex extends Component
{
    public $setIndex = 0;


    public function setState($index)
    {
        $this->setIndex = $index;
    }

    #[Layout('layouts.main')]
    public function render()
    {
        return view('livewire.dividen.dividen-index');
    }
}
