<?php

namespace App\Services\Model;

use App\Models\Ref\RefBank;

/**
 * Service class for managing bank-related operations.
 */
class BankService
{
    /**
     * Fetches all reference banks from the database.
     *
     * @return \Illuminate\Database\Eloquent\Collection Collection of RefBank models.
     */
    public static function getAllRefBanks()
    {
        return RefBank::all();
    }
}
