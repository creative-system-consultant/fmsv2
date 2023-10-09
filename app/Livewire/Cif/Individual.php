<?php

namespace App\Livewire\Cif;

use App\Models\Cif\CifCustomer;
use Livewire\Component;
use Livewire\WithPagination;

class Individual extends Component
{
    use WithPagination;
    public $model, $search;

    // public function mount()
    // {
    //     $this->customers = CifCustomer::paginate(10);
    //     // dd($this->customers);
    // }

    public function render()
    {
        $query = CifCustomer::query();
        // dump($this->search);

        // Apply search filter if a search term is provided
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%')
                ->orWhere('icno', 'like', '%' . $this->search . '%')
                ->orWhere('ref_no', 'like', '%' . $this->search . '%');
            // ->orWhere('staff_no', 'like', '%' . $this->search . '%');
        }

        // If search is empty, retrieve all records
        if (empty($this->search)) {
            $customers = CifCustomer::paginate(10);
        } else {
            $customers = $query->paginate(10);
        }

        return view('livewire.cif.individual', ['customers' => $customers])
            ->extends('layouts.main');
    }
}
