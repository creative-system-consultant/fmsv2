<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsGenerateFinancingAdv
{
    protected $sp = 'FMS.generate_financing_adv';

    public function __construct()
    {
        //
    }

    public function handle($accountNo)
    {
        $sql = "exec {$this->sp} :accountNo";
        $result = DB::select($sql, ['accountNo' => $accountNo]);

        if (isset($result[0]->{""})) {
            return $result[0]->{""};
        }

        return null;
    }
}