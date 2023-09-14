<?php

namespace App\Livewire\Doc;

use Livewire\Component;

class Doc extends Component
{
    public function render()
    {
        return view('livewire.doc.doc')->extends('doc.doc-head');
    }
}
