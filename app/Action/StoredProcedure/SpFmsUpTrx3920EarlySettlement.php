<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsUpTrx3920EarlySettlement
{
    public function __construct()
    {
        //
    }

    public static function handle($data)
    {
        // Define the name of the stored procedure.
        $sp = 'FMS.up_trx_3920_early_settlement';

        // Construct the SQL statement to execute the stored procedure with provided parameters.
        $sql = "SET NOCOUNT ON; exec " . $sp . "  :clientId, :accNo, :txnAmt, :txnCode, :docNo, :txnDate, :userId, :remarks, :bankClient";

        // Execute the statement using Laravel's database query builder and capture the result.
        $result = DB::statement($sql, $data);

        // Return the result of the statement execution.
        return $result;
    }
}