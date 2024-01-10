<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsUpTrxMiscInBk
{
    public function __construct()
    {
        //
    }

    public static function handle($data)
    {
        // Define the name of the stored procedure.
        $sp = 'FMS.up_trx_misc_in_bk';

        // Construct the SQL statement to execute the stored procedure with provided parameters.
        $sql = "exec " . $sp . "  :clientId, :mbrNo, :txnAmt, :txnDate, :txnCode, :remarks, :userId, :thirdPartyCode, :bankClient";

        // Execute the statement using Laravel's database query builder and capture the result.
        $result = DB::select($sql, $data);

        // Return the result of the statement execution.
        return $result;
    }
}