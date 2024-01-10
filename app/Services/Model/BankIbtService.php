<?php

namespace App\Services\Model;

use App\Models\Ref\RefBankIbt;

/**
 * This service class is responsible for operations related to 'RefBankIbt'.
 */
class BankIbtService
{
    /**
     * Retrieves all records from the 'RefBankIbt' model.
     *
     * @return \Illuminate\Database\Eloquent\Collection Collection of RefBankIbt records.
     */
    public static function getAllRefBankIbts($clientID)
    {
        return RefBankIbt::where('client_id', $clientID)->get();
    }
}
