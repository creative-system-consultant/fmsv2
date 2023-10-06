<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsUpTrx3950RefundAdvance
{
    protected $sp = 'FMS.up_trx_3950_refund_advance';

    public function __construct()
    {
        //
    }

    public function handle($data)
    {
        $sql = "exec {$this->sp} :accountNo, :amount, :transactionDate, :txnCode, :remark, :documentNo, :userId, :bank, :bankIbt";
        DB::statement($sql, $data);

        return 'DONE';
    }
}