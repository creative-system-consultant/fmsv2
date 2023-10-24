<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptMthArrearAgeing
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_mth_ageing :clientId, :reportDate", $input);   
    }
    public static function formatData($data)
    {
        return [
            'PRODUCT ID' => [
                'value' => $data->product_id,
                'align' => 'left'
            ],
            'PRODUCTS' => [
                'value' => $data->products,
                'align' => 'left'
            ],
            'TOTAL BIL' => [
                'value' => number_format($data->tot_bil, 2),
                'align' => 'right'
            ],
            'APPROVED LIMIT' => [
                'value' => number_format($data->approved_limit, 2),
                'align' => 'right'
            ],
            'INSTAL AMOUNT' => [
                'value' => number_format($data->instal_amount, 2),
                'align' => 'right'
            ],
            'BAL_OUTSTANDING' => [
                'value' => number_format($data->bal_outstanding, 2),
                'align' => 'right'
            ],
            'UEI_OUTSTANDING' => [
                'value' => number_format($data->uei_outstanding, 2),
                'align' => 'right'
            ],
            'PRINT OUTSTANDING' => [
                'value' => number_format($data->prin_outstanding, 2),
                'align' => 'right'
            ],
            'BIL 1' => [
                'value' => $data->bil1,
                'align' => 'right'
            ],
            'MONTH1' => [
                'value' => number_format($data->month1, 2),
                'align' => 'right'
            ],
            'BIL 2' => [
                'value' => $data->bil2,
                'align' => 'right'
            ],
            'MONTH2' => [
                'value' => number_format($data->month2, 2),
                'align' => 'right'
            ],
            'BIL 3' => [
                'value' => $data->bil3,
                'align' => 'right'
            ],
            'MONTH3' => [
                'value' => number_format($data->month3, 2),
                'align' => 'right'
            ],
            'BIL 4' => [
                'value' => $data->bil4,
                'align' => 'right'
            ],
            'MONTH4' => [
                'value' => number_format($data->month4, 2),
                'align' => 'right'
            ],
            'BIL 5' => [
                'value' => $data->bil5,
                'align' => 'right'
            ],
            'MONTH5' => [
                'value' => number_format($data->month5, 2),
                'align' => 'right'
            ],
            'BIL 6' => [
                'value' => $data->bil6,
                'align' => 'right'
            ],
            'MONTH6' => [
                'value' => number_format($data->month6, 2),
                'align' => 'right'
            ],
            'BIL 7' => [
                'value' => $data->bil7,
                'align' => 'right'
            ],
            'MONTH7' => [
                'value' => number_format($data->month7, 2),
                'align' => 'right'
            ],
            'BIL_MORE_THEN 7' => [
                'value' => $data->bil_more_then_7,
                'align' => 'right'
            ],
            'MORE_THEN_7' => [
                'value' => number_format($data->more_then_7 , 2),
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