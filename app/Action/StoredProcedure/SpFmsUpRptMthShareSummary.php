<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptMthShareSummary
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_mth_share_everymonth :clientId, :reportDate", $input);   
    }
    public static function formatData($data)
    {
        return [
            'JAN' => [
                'value' => $data->Jan,
                'align' => 'left'
            ],
            'PAYMENT1' => [
                'value' => number_format($data->payment1, 2),
                'align' => 'right'
            ],
            'WITHDRAWAL1' => [
                'value' => number_format($data->withdrawal1, 2),
                'align' => 'right'
            ],
            'TOTAL_AMOUNT1' => [
                'value' => number_format($data->total_amount1, 2),
                'align' => 'right'
            ],
            'FEB' => [
                'value' => $data->Feb,
                'align' => 'left'
            ],
            'PAYMENT2' => [
                'value' => number_format($data->payment2, 2),
                'align' => 'right'
            ],
            'WITHDRAWAL2' => [
                'value' => number_format($data->withdrawal2, 2),
                'align' => 'right'
            ],
            'TOTAL_AMOUNT2' => [
                'value' => number_format($data->total_amount2, 2),
                'align' => 'right'
            ],
            'MAC' => [
                'value' => $data->Mac,
                'align' => 'left'
            ],
            'PAYMENT3' => [
                'value' => number_format($data->payment3, 2),
                'align' => 'right'
            ],
            'WITHDRAWAL3' => [
                'value' => number_format($data->withdrawal3, 2),
                'align' => 'right'
            ],
            'TOTAL_AMOUNT3' => [
                'value' => number_format($data->total_amount3, 2),
                'align' => 'right'
            ],
            'APR' => [
                'value' => $data->Apr,
                'align' => 'left'
            ],
            'PAYMENT4' => [
                'value' => number_format($data->payment4, 2),
                'align' => 'right'
            ],
            'WITHDRAWAL4' => [
                'value' => number_format($data->withdrawal4, 2),
                'align' => 'right'
            ],
            'TOTAL_AMOUNT4' => [
                'value' => number_format($data->total_amount4, 2),
                'align' => 'right'
            ],
            'MAY' => [
                'value' => $data->May,
                'align' => 'left'
            ],
            'PAYMENT5' => [
                'value' => number_format($data->payment5, 2),
                'align' => 'right'
            ],
            'WITHDRAWAL5' => [
                'value' => number_format($data->withdrawal5, 2),
                'align' => 'right'
            ],
            'TOTAL_AMOUNT5' => [
                'value' => number_format($data->total_amount5, 2),
                'align' => 'right'
            ],
            'JUN' => [
                'value' => $data->Jun,
                'align' => 'left'
            ],
            'PAYMENT6' => [
                'value' => number_format($data->payment6, 2),
                'align' => 'right'
            ],
            'WITHDRAWAL6' => [
                'value' => number_format($data->withdrawal6, 2),
                'align' => 'right'
            ],
            'TOTAL_AMOUNT6' => [
                'value' => number_format($data->total_amount6, 2),
                'align' => 'right'
            ],
            'JUL' => [
                'value' => $data->Jul,
                'align' => 'left'
            ],
            'PAYMENT7' => [
                'value' => number_format($data->payment7, 2),
                'align' => 'right'
            ],
            'WITHDRAWAL7' => [
                'value' => number_format($data->withdrawal7, 2),
                'align' => 'right'
            ],
            'TOTAL_AMOUNT7' => [
                'value' => number_format($data->total_amount7, 2),
                'align' => 'right'
            ],
            'AUG' => [
                'value' => $data->Aug,
                'align' => 'left'
            ],
            'PAYMENT8' => [
                'value' => number_format($data->payment8, 2),
                'align' => 'right'
            ],
            'WITHDRAWAL8' => [
                'value' => number_format($data->withdrawal8, 2),
                'align' => 'right'
            ],
            'TOTAL_AMOUNT8' => [
                'value' => number_format($data->total_amount8, 2),
                'align' => 'right'
            ],
            'SEP' => [
                'value' => $data->Sep,
                'align' => 'left'
            ],
            'PAYMENT9' => [
                'value' => number_format($data->payment9, 2),
                'align' => 'right'
            ],
            'WITHDRAWAL9' => [
                'value' => number_format($data->withdrawal9, 2),
                'align' => 'right'
            ],
            'TOTAL_AMOUNT9' => [
                'value' => number_format($data->total_amount9, 2),
                'align' => 'right'
            ],
            'OCT' => [
                'value' => $data->Oct,
                'align' => 'left'
            ],
            'PAYMENT10' => [
                'value' => number_format($data->payment10, 2),
                'align' => 'right'
            ],
            'WITHDRAWAL10' => [
                'value' => number_format($data->withdrawal10, 2),
                'align' => 'right'
            ],
            'TOTAL_AMOUNT10' => [
                'value' => number_format($data->total_amount10, 2),
                'align' => 'right'
            ],
            'NOV' => [
                'value' => $data->Nov,
                'align' => 'left'
            ],
            'PAYMENT11' => [
                'value' => number_format($data->payment11, 2),
                'align' => 'right'
            ],
            'WITHDRAWAL11' => [
                'value' => number_format($data->withdrawal11, 2),
                'align' => 'right'
            ],
            'TOTAL_AMOUNT11' => [
                'value' => number_format($data->total_amount11, 2),
                'align' => 'right'
            ],
            'DEC' => [
                'value' => $data->Dec,
                'align' => 'left'
            ],
            'PAYMENT12' => [
                'value' => number_format($data->payment12, 2),
                'align' => 'right'
            ],
            'WITHDRAWAL12' => [
                'value' => number_format($data->withdrawal12, 2),
                'align' => 'right'
            ],
            'TOTAL_AMOUNT12' => [
                'value' => number_format($data->total_amount12, 2),
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