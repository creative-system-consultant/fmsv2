<?php

namespace App\Services\Model;

use App\Models\Ref\RefBankIbt;

class BankIbtService
{
    public function __construct()
    {
        //
    }

    public static function getAllRefBankIbts()
    {
        return RefBankIbt::all();
    }
}