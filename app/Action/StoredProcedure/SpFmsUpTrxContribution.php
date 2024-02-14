<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsUpTrxContribution
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
        $sp = 'fms.up_trx_contribution';

        // Construct the SQL statement to execute the stored procedure with provided parameters.
        $sql = "SET NOCOUNT ON; exec " . $sp . "  :clientId, :mbrNo, :txnAmt, :txnDate, :docNo, :txnCode, :remarks, :bankMember, :userId, :chequeDate, :bankClient, :idApply";

        // Execute the statement using Laravel's database query builder and capture the result.
        $result = DB::select($sql, $data);

        // Return the result of the statement execution.
        return $result;
    }
}