<?php

namespace App\Livewire\Teller\Autopay;

use App\Models\Fms\FmsAutopayExceptionsDetail;
use App\Traits\Teller\Autopay\DetailsException as AutoPayDetailsException;
use Livewire\Component;
use Livewire\WithPagination;

class DetailsException extends Component
{
    use WithPagination,AutoPayDetailsException;

    public $search;

    public function render()
    {
        $searchTerm = '%' . $this->search . '%';
        $data = FmsAutopayExceptionsDetail::where(function ($q) use ($searchTerm) {
                return $q->where('mbr_no', 'like', $searchTerm)
                    ->orWhere('name', 'like', $searchTerm)
                    ->orWhere('staffno', 'like', $searchTerm)
                    ->orWhere('identity_no', 'like', $searchTerm);
            })
            ->orderBy('FMS.AUTOPAY_EXCEPTIONS_DETAIL.mbr_no')
            ->paginate(10);

        return view('livewire.teller.autopay.details-exception', [
            'data' => $data
        ]);
    }
}
