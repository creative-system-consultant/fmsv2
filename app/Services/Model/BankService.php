<?php

namespace App\Services\Model;

use App\Models\Ref\RefBank;

class BankService
{
    public function __construct()
    {
        //
    }

    public static function getAllRefBanks()
    {
        return RefBank::all();
    }
}