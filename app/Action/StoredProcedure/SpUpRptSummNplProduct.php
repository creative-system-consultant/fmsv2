<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpUpRptSummNplProduct
{
    public static function getRawData($input)
    {
        return DB::select("rpt.up_rpt_summ_npl_product :clientId, :reportDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'Total Account'  => [
                'value' =>  $data->TOTAL_ACCT,
                'align' => 'left'
            ],
            'Product Id' => [
                'value' => $data->product_id,
                'align' => 'right'
            ],
            'No of Account' => [
                'value' => $data->NO_OFACCT,
                'align' => 'right'
            ],
            'Balance Outstanding' => [
                'value' => $data->BAL_OUT,
                'align' => 'right'
            ],
            'Principal Outstanding'  => [
                'value' =>  $data->PRIN_OUT,
                'align' => 'left'
            ],
            'Profit Amount' => [
                'value' => $data->PROFIT_AMT,
                'align' => 'right'
            ],
            'Arrears Amount' => [
                'value' => $data->ARREARS_AMT,
                'align' => 'right'
            ],
            'Provision' => [
                'value' => $data->provision,
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