<?php

namespace App\Livewire\Teller\RefundAdvance;

use App\Services\Module\RefundAdvance;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class RefundAdvanceList extends Component
{
    use WithPagination;

    public $search_by = 'cif.customers.name';
    public $search = '';
    public $selectedAccNo = NULL;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('clearSelectedAcc')]
    public function clearSelectedAcc()
    {
        $this->selectedAccNo = NULL;
    }

    public function selectAcc($accountNo)
    {
        $this->selectedAccNo = $accountNo;
    }

    public function render()
    {
        $advance = RefundAdvance::getAdvanceList($this->search_by, $this->search);

        return view('livewire.teller.refund-advance.refund-advance-list', [
            'advance' => $advance,
        ])->extends('layouts.main');
    }
}
