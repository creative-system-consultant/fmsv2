<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsGenerateMbrMisc
{
    public function __construct()
    {
        //
    }

    public static function handle($data)
    {
        // Define the name of the stored procedure.
        $sp = 'FMS.generate_mbr_misc';

        // Construct the SQL statement to execute the stored procedure with provided parameters.
        $sql = "exec " . $sp . " :clientId, :mbrNo";

        // Execute the statement using Laravel's database query builder and capture the result.
        $result = DB::statement($sql, $data);

        // Return the result of the statement execution.
        return $result;
    }
}