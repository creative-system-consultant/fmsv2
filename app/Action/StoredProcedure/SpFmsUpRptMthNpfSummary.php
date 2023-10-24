<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptMthNpfSummary
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_summ_npl_product :clientId, :reportDate", $input);   
    }
    public static function formatData($data)
    {
        return [
            'TOTAL_ACCT' => [
                'value' => number_format($data->TOTAL_ACCT, 2),
                'align' => 'left'
            ],
            'PRODUCT ID' => [
                'value' => $data->product_id,
                'align' => 'left'
            ],
            'NO_OFACCT' => [
                'value' => number_format($data->NO_OFACCT, 2),
                'align' => 'right'
            ],
            'BAL_OUT' => [
                'value' => number_format($data->BAL_OUT, 2),
                'align' => 'right'
            ],
            'PRIN_OUT' => [
                'value' => number_format($data->PRIN_OUT, 2),
                'align' => 'right'
            ],
            'PROFIT_AMT' => [
                'value' => number_format($data->PROFIT_AMT, 2),
                'align' => 'right'
            ],
            'ARREARS_AMT' => [
                'value' => number_format($data->ARREARS_AMT, 2),
                'align' => 'right'
            ],
            'PROVISION' => [
                'value' => number_format($data->provision, 0),
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