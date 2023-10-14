<?php

namespace App\Action\StoredProcedure;

use DB;

/**
 * Action class to execute the FMS.generate_financing_adv stored procedure.
 */
class SpFmsGenerateFinancingAdv
{
    /**
     * Handles the execution of the stored procedure with the given parameters.
     *
     * @param int|string $clientId  The client identifier.
     * @param int|string $accountNo The account number.
     *
     * @return mixed|null The result of the stored procedure or null if no result.
     */
    public static function handle($clientId, $accountNo)
    {
        // Define the stored procedure name
        $sp = 'FMS.generate_financing_adv';

        // Construct the SQL command to execute the stored procedure
        $sql = "exec " . $sp . " :client_id, :account_no";

        // Execute the stored procedure and fetch the result
        $result = DB::select($sql, [
            'client_id' => $clientId,
            'account_no' => $accountNo
        ]);

        // Check if the result has an unnamed property (uncommon) and return it if present
        if (isset($result[0]->{""})) {
            return $result[0]->{""};
        }

        // Return null if no result found
        return null;
    }
}
