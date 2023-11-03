<?php

namespace App\Livewire\Cif;

use App\Services\Model\CifCustomer;
use Livewire\Component;
use Livewire\WithPagination;

class Individual extends Component
{
    use WithPagination;

    public $searchBy = 'name';
    public $search;

    public function render()
    {
        $relationship = ['membership'];
        // Retrieve customers based on conditions, search field and search term
        $customers = CifCustomer::fetchByCondition([], $this->searchBy, $this->search, null, null, $relationship);
        // dd($customers);


        return view('livewire.cif.individual', ['customers' => $customers])
            ->extends('layouts.main');
    }
}
