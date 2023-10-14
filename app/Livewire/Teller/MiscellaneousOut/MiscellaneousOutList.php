<?php

namespace App\Livewire\Teller\MiscellaneousOut;

use App\Services\Model\FmsMiscAccount;
use App\Services\Module\Teller\MiscOut;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

class MiscellaneousOutList extends Component
{
    use WithPagination;

    public $searchBy = 'name';
    public $search;
    public $selectedMbr = NULL;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function selectMbr($mbrNo)
    {
        $this->selectedMbr = $mbrNo;
    }

    public function render()
    {
        $members = MiscOut::getData($this->searchBy, $this->search);

        return view('livewire.teller.miscellaneous-out.miscellaneous-out-list', [
            'members' => $members
        ])->extends('layouts.main');
    }
}
