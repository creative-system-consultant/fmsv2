<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsUpTrxRetirementProcess
{
    public static function handle($data)
    {
        // Define the name of the stored procedure.
        $sp = 'FMS.up_trx_retirement_process_v2';

        // Construct the SQL statement to execute the stored procedure with provided parameters.
        $sql = "exec " . $sp . " :clientId, :mbrNo, :txnAmt, :txnDate, :docNo, :remarks, :userId, :bankClient";

        // Execute the statement using Laravel's database query builder and capture the result.
        $result = DB::select($sql, $data);

        // Return the result of the statement execution.
        return $result;
    }
}