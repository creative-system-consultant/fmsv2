<?php

namespace App\Action\StoredProcedure;
use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptMthArrearAccState
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_mth_arrears_acc_bynegeri :clientId, :reportDate", $input);   
    }
    public static function formatData($data)
    {
        return [
            'NEGERI' => [
                'value' => $data->negeri,
                'align' => 'left'
            ],
            'BALANCE OUTS' => [
                'value' => number_format($data->balance_outs, 2),
                'align' => 'right'
            ],
            'TOTAL PRIN OUTSTANDING' => [
                'value' => number_format($data->total_prin_outstanding, 2),
                'align' => 'right'
            ],
            'TOTAL UEI OUTSTANDING' => [
                'value' => number_format($data->total_uei_outstanding, 2),
                'align' => 'right'
            ],
            'TOTAL INSAL ARREARS' => [
                'value' => number_format($data->total_instal_arrears, 2),
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