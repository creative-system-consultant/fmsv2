<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptListFinancingTrxOnDisb
{
    public static function getRawData($input)
    {
        return DB::select("fms.up_rpt_list_financing_trx_on_disb :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'MBR_NO' => [
                'value' => $data->MEMBERSHIP_NO,
                'align' => 'left'
            ],
            'NAME' => [
                'value' => $data->NAME,
                'align' => 'right'
            ],
            'ACCOUNT NO' => [
                'value' => $data->ACCOUNT_NO,
                'align' => 'right'
            ],
            'PRODUCTS'  => [
                'value' => $data->PRODUCTS,
                'align' => 'right'
            ],
            'PAYMENT TYPE'  => [
                'value' =>  $data->PAYMENT_TYPE,
                'align' => 'right'
            ],
            'SELLING PRICE'  => [
                'value' => $data->SELLING_PRICE,
                'align' => 'right'
            ],
            'PURCASE PRICE' => [
                'value' => $data->PURCASE_PRICE,
                'align' => 'right'
            ],
            'PRIN OUTSTANDING'  => [
                'value' => $data->PRIN_OUTSTANDING,
                'align' => 'right'
            ],
            'UEI OUTSTANDING'   => [
                'value' => $data->UEI_OUTSTANDING,
                'align' => 'right'
            ],
            'INSTALMENT AMOUNT'  => [
                'value' => $data->INSTALMENT_AMOUNT,
                'align' => 'right'
            ],
            'START DISBURSED DATE'   => [
                'value' => $data->START_DISBURSED_DATE,
                'align' => 'right'
            ],
            'MONTH DISBURSED DATE'  => [
                'value' => $data->MONTH_DISBURSED_DATE,
                'align' => 'right'
            ],
            'TRANSACTION TYPE'   => [
                'value' => $data->TRANSACTION_TYPE,
                'align' => 'right'
            ],
            'TRANSACTION DATE' => [
                'value' => $data->TRANSACTION_DATE,
                'align' => 'right'
            ],
            'TRANSACTION MONTH'  => [
                'value' => $data->TRANSACTION_MONTH,
                'align' => 'right'
            ],
            'TRANSACTION MONTH'  => [
                'value' => $data->TRANSACTION_MONTH,
                'align' => 'right'
            ],
            'CURRENT INSTALMENT[ NO' => [
                'value' => $data->CURRENT_INSTALMENT_NO,
                'align' => 'right'
            ],
            'TRANSACTION AMOUNT'   => [
                'value' => $data->TRANSACTION_AMOUNT,
                'align' => 'right'
            ],
            'PRINCIPAL'    => [
                'value' => $data->PRINCIPAL,
                'align' => 'right'
            ],
            'PROFIT'     => [
                'value' => $data->PROFIT,
                'align' => 'right'
            ],
            'ADVANCE PAYMENT'   => [
                'value' => $data->ADVANCE_PAYMENT,
                'align' => 'right'
            ],
            'BALANCE OUTSTANDING'  => [
                'value' => $data->BAL_OUTSTANDING,
                'align' => 'right'
            ],
            'MONTH ARREARS'    => [
                'value' =>  $data->MONTH_ARREARS,
                'align' => 'right'
            ],
            'INSTAL ARREARS'     => [
                'value' =>  $data->INSTAL_ARREARS,
                'align' => 'right'
            ],
            'PROFIT ARREARS'    => [
                'value' =>  $data->PROFIT_ARREARS,
                'align' => 'right'
            ],
        ];
    }

    public static function formatDataForExcel($data)
    {
        $formattedData = self::formatData($data);
        $excelData = [];

        foreach ($formattedData as $column => $cell) {
            $excelData[$column] = $cell['value'];
        }

        return $excelData;
    }

    public static function handleForExcel($input, $format = false)
    {
        $rawData = self::getRawData($input);
        foreach ($rawData as $data) {
            $formattedData = $format ? self::formatDataForExcel($data) : $data;
            yield $formattedData;
        }
    }

    public static function handleForTable($rawData, $format = false)
    {
        $formattedData = [];
        foreach ($rawData as $data) {
            
            $formattedData[] = $format ? self::formatData($data) : $data;
        }
        return new Collection($formattedData);
    }
}