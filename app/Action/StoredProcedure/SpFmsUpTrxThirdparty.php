<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsUpTrxThirdparty
{
    public function __construct()
    {
        //
    }

    public static function handle($data)
    {
        // Define the name of the stored procedure.
        $sp = 'FMS.up_trx_thirdparty';

        // Construct the SQL statement to execute the stored procedure with provided parameters.
        $sql = "exec " . $sp . "  :clientId, :mbrNo, :instiCode, :paymentMode, :txnAmt, :txnDate, :docNo, :bankMember, :chequeNo, :chequeDate, :remarks, :userId, :mode, :bankClient, :idThirdParty";

        // Execute the statement using Laravel's database query builder and capture the result.
        $result = DB::statement($sql, $data);

        // Return the result of the statement execution.
        return $result;
    }
}