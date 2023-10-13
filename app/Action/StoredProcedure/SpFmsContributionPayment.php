<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsContributionPayment
{
    public static function handle($input)
    {
        $rawData = DB::select("fms.up_rpt_contribution_payment :clientId, :startDate, :endDate", $input);

        foreach ($rawData as $data) {
            yield $data;
        }
    }
}