<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptMthFinSummaryYearly
{
    public static function getRawData($input)
    {
    return DB::select("RPT.up_rpt_financing_summary_yearly :clientId, :reportDate", $input);   
    }
    public static function formatData($data)
    {
        return [
            'PRODUCT ID' => [
                'value' => $data->prod_id,
                'align' => 'left'
            ],
            'PRODUCT DESCRIPTION' => [
                'value' => $data->prod_desc,
                'align' => 'left'
            ],
            'PRODUCT TYPE' => [
                'value' => $data->product_type,
                'align' => 'left'
            ],
            'OPENING PRINCIPAL' => [
                'value' => number_format($data->opening_principal, 2),
                'align' => 'right'
            ],
            'OPENING PROFIT' => [
                'value' => number_format($data->opening_profit, 2),
                'align' => 'right'
            ],
            'DISBURSED PRINCIPAL' => [
                'value' => number_format($data->disbursed_principal, 2),
                'align' => 'right'
            ],
            'DISBURSED PROFIT' => [
                'value' => number_format($data->disbursed_profit, 2),
                'align' => 'right'
            ],
            'TRANSACTION PRINCIPAL' => [
                'value' => number_format($data->transaction_principal, 2),
                'align' => 'right'
            ],
            'TRANSACTION PROFIT' => [
                'value' => number_format($data->transaction_profit, 2),
                'align' => 'right'
            ],
            'TRANSACTION REBATE' => [
                'value' => number_format($data->transaction_rebate, 2),
                'align' => 'right'
            ],
            'ADJUSTMENT PRINCIPAL' => [
                'value' => number_format($data->adjustment_principal, 2),
                'align' => 'right'
            ],
            'ADJUSTMENT PROFIT' => [
                'value' => number_format($data->adjustment_profit, 2),
                'align' => 'right'
            ],
            'CLOSING PRINCIPAL' => [
                'value' => number_format($data->closing_principal, 2),
                'align' => 'right'
            ],
            'CLOSING PROFIT' => [
                'value' => number_format($data->closing_profit, 2),
                'align' => 'right'
            ],
            'ADVANCE PAYMENT' => [
                'value' => number_format($data->advance_payment, 2),
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