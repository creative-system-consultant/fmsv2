<?php

namespace App\Livewire\Cif\Other;

use App\Services\Model\CifCustomer;
use Livewire\Component;
use Livewire\WithPagination;

class OtherInfoList extends Component
{

    use WithPagination;

    public $searchBy = 'name';
    public $search;
    public $uuid;
    public $setIndex = 0;

    public function setState($index)
    {
        $this->setIndex = $index;
    }

    public function render()
    {
        $relationship = ['membership'];
        $customers = CifCustomer::fetchByCondition([], $this->searchBy, $this->search, null, null, $relationship);
        return view('livewire.cif.other.other-info-list', ['customers' => $customers])->extends('layouts.main');
    }
}
