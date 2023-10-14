<?php

namespace App\Livewire\Cif;

use App\Services\Model\CifCustomer;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class Individual extends Component
{
    use WithPagination;

    public $searchBy = 'name';
    public $search;

    public function render()
    {
        // Retrieve customers based on conditions, search field and search term
        $customers = CifCustomer::fetchByCondition([], $this->searchBy, $this->search, null, null,[]);

        return view('livewire.cif.individual', ['customers' => $customers])->extends('layouts.main');
    }
}
