<?php

namespace App\Livewire\Teller\TransferShare;

use App\Models\Siskop\SiskopTransferShare;
use Livewire\Component;

class TransferShare extends Component
{
    public $searchTerm = '';

    public function render()
    {
        $datas = SiskopTransferShare::where('direction', 'exchange')
            ->where('flag', 0)
            ->get();

        return view('livewire.teller.transfer-share.transfer-share', [
            'datas' => $datas,
        ])->extends('layouts.main');
    }
}
