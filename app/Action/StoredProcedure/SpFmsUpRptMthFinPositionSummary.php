<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptMthFinPositionSummary
{
    
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_mth_financing_position_summary :clientId, :reportDate", $input);   
    }
    public static function formatData($data)
    {
        return [
            'PRODUCT ID' => [
                'value' => $data->product,
                'align' => 'left'
            ],
            'APPROVED LIMIT' => [
                'value' => number_format($data->approved_limit, 2),
                'align' => 'right'
            ],
            'SELLING PRICE' => [
                'value' => number_format($data->selling_price, 2),
                'align' => 'right'
            ],
            'DISBURSED AMOUNT' => [
                'value' => number_format($data->disbursed_amount, 2),
                'align' => 'right'
            ],
            'UNDRAWN AMOUNT' => [
                'value' => number_format($data->undrawn_amount, 2),
                'align' => 'right'
            ],
            'BALANCE_OUTS' => [
                'value' => number_format($data->balance_outs, 2),
                'align' => 'right'
            ],
            'PRIN_OUTSTANDING' => [
                'value' => number_format($data->prin_outstanding, 2),
                'align' => 'right'
            ],
            'UEI_OUTSTANDING' => [
                'value' => number_format($data->uei_outstanding, 2),
                'align' => 'right'
            ],
            'PAYMENT AMOUNT' => [
                'value' => number_format ($data->payment_amount, 2),
                'align' => 'right'
            ],
            'TOTAL PROFIT EARNED' => [
                'value' => number_format($data->tot_profit_earned, 2),
                'align' => 'right'
            ],
            'PRINCIPLE COLLECTED' => [
                'value' => number_format($data->princp_collected, 2),
                'align' => 'right'
            ],
            'ADVANCE_AMOUNT' => [
                'value' => number_format($data->advance_amt, 2),
                'align' => 'right'
            ],
            'MONTH_ARREARS' => [
                'value' => number_format($data->month_arrears, 2),
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