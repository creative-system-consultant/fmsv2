<?php

namespace App\Action\StoredProcedure;

use DB;

class SpFmsUpRptListFinancingTrxOnDisb
{
    public static function handle($input)
    {
        $rawData = DB::select("fms.up_rpt_list_financing_trx_on_disb :clientId, :startDate, :endDate", $input);

        foreach ($rawData as $data) {
            yield [
                'MEMBERSHIP NO'          => $data->MEMBERSHIP_NO,
                'NAME'                   => $data->NAME,
                'ACCOUNT NO'             => $data->ACCOUNT_NO,
                'PRODUCTS'               => $data->PRODUCTS,
                'PAYMENT TYPE'           => $data->PAYMENT_TYPE,
                'SELLING PRICE'          => $data->SELLING_PRICE,
                'PURCASE PRICE'          => $data->PURCASE_PRICE,
                'PRIN OUTSTANDING'       => $data->PRIN_OUTSTANDING,
                'UEI OUTSTANDING'        => $data->UEI_OUTSTANDING,
                'INSTALMENT AMOUNT'      => $data->INSTALMENT_AMOUNT,
                'START DISBURSED DATE'   => $data->START_DISBURSED_DATE,
                'MONTH DISBURSED DATE'   => $data->MONTH_DISBURSED_DATE,
                'TRANSACTION TYPE'       => $data->TRANSACTION_TYPE,
                'TRANSACTION DATE'       => $data->TRANSACTION_DATE,
                'TRANSACTION MONTH'      => $data->TRANSACTION_MONTH,
                'CURRENT INSTALMENT[ NO' => $data->CURRENT_INSTALMENT_NO,
                'TRANSACTION AMOUNT'     => $data->TRANSACTION_AMOUNT,
                'PRINCIPAL'              => $data->PRINCIPAL,
                'PROFIT'                 => $data->PROFIT,
                'ADVANCE PAYMENT'        => $data->ADVANCE_PAYMENT,
                'BALANCE OUTSTANDING'    => $data->BAL_OUTSTANDING,
                'MONTH ARREARS'          => $data->MONTH_ARREARS,
                'INSTAL ARREARS'         => $data->INSTAL_ARREARS,
                'PROFIT ARREARS'         => $data->PROFIT_ARREARS,
            ];
        }
    }
}