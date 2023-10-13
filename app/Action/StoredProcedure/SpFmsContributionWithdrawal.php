<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsContributionWithdrawal
{
    public static function handle($input)
    {
        $rawData = DB::select("fms.up_rpt_contribution_withrawal :clientId, :startDate, :endDate", $input);

        foreach ($rawData as $data) {
           yield $data;
        }
    }
}