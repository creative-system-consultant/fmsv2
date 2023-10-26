<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsUpTrxPreSettlemtPostn
{
    public function __construct()
    {
        //
    }

    public static function handle($data)
    {
        // Define the name of the stored procedure.
        $sp = 'FMS.up_trx_pre_settlemt_postn';

        // Construct the SQL statement to execute the stored procedure with provided parameters.
        $sql = "exec " . $sp . " :clientId, :accNo, :userId, :idMsg, :accId";

        // Execute the statement using Laravel's database query builder and capture the result.
        $result = DB::connection('fms')->statement($sql, $data);

        // Return the result of the statement execution.
        return $result;
    }
}