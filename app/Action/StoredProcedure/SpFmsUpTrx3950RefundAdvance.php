<?php

namespace App\Action\StoredProcedure;

use DB;

/**
 * This class is responsible for executing the stored procedure named 'FMS.up_trx_3950_refund_advance'.
 */
class SpFmsUpTrx3950RefundAdvance
{
    /**
     * Executes the stored procedure with the given data.
     *
     * @param array $data The data to be used in the stored procedure.
     * @return string Returns 'DONE' upon successful execution.
     */
    public static function handle($data)
    {
        // Name of the stored procedure.
        $sp = 'FMS.up_trx_3950_refund_advance';

        // Construct the SQL statement for executing the stored procedure.
        $sql = "exec " . $sp . " :clientId, :accNo, :txnAmt, :txnDate, :txnCode, :remarks, :docNo, :userId, :bankMember, :bankClient";

        // Execute the SQL statement using Laravel's database facade.
        DB::statement($sql, $data);

        // Return 'DONE' upon successful execution.
        return 'DONE';
    }
}
