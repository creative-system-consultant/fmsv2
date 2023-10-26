<?php

namespace App\Action\StoredProcedure;

use DB;

/**
 * Class SpFmsUpTrxContributionIn
 *
 * This class handles the execution of the `up_trx_contribution_in` stored procedure.
 */
class SpFmsUpTrxContributionIn
{
    /**
     * Execute the stored procedure with the provided data.
     *
     * @param array $data Associative array of parameters to be passed to the stored procedure.
     * @return bool Indicates whether the statement was executed successfully.
     */
    public static function handle($data)
    {
        // Define the name of the stored procedure.
        $sp = 'up_trx_contribution_in';

        // Construct the SQL statement to execute the stored procedure with provided parameters.
        $sql = "SET NOCOUNT ON; exec " . $sp . "  :clientId, :mbrNo, :txnAmt, :txnDate, :docNo, :txnCode, :remarks, :bankMember, :userId, :chequeDate, :bankClient";

        // Execute the statement using Laravel's database query builder and capture the result.
        $result = DB::connection('fms')->statement($sql, $data);

        // Return the result of the statement execution.
        return $result;
    }
}
