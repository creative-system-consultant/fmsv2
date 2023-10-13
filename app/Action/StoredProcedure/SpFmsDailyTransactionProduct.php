<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsDailyTransactionProduct
{
    public static function handle($input)
    {
        $rawData = DB::select("fms.up_rpt_daily_trx_products :clientId, :startDate, :endDate", $input);

        foreach ($rawData as $data) {
            yield $data;
        }
    }
}