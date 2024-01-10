<?php

namespace App\Livewire\Teller\WithdrawDividen;

use DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;

class WithdrawDividen extends Component
{
    public $search = '';

    public function render()
    {
        $page = LengthAwarePaginator::resolveCurrentPage() ?: 1;
        $pageSize = 10;
        $offset = ($page * $pageSize) - $pageSize;
        $dividend = DB::select('EXEC FMS.up_teller_dividend_list ?', array($this->search));
        $paginator = new LengthAwarePaginator(array_slice($dividend, $offset, $pageSize, true), count($dividend), $pageSize, $page, ['path' => LengthAwarePaginator::resolveCurrentPath()]);

        return view('livewire.teller.withdraw-dividen.withdraw-dividen', [
            'dividend' => $paginator,
        ])->extends('layouts.main');
    }
}
