<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptDetailGl
{
    public static function getRawData($input)
    {
    return DB::select("RPT.up_rpt_gl_details :clientId, :reportDate, :gl_desc", $input);   
    }
    public static function formatData($data)
    {
        return [
            'ROW_NO' => [
                'value' => $data->row_no,
                'align' => 'left'
            ],
            'REPORT_DATE' => [
                'value' => date('Y-m-d', strtotime($data->report_date)),
                'align' => 'left'
            ],
            'DESCRIPTIONS' => [
                'value' => $data->descriptions,
                'align' => 'left'
            ],  
            'MBR_NO' => [
                'value' => $data->MBR_NO,
                'align' => 'left'
            ],
            'NAME' => [
                'value' => $data->name,
                'align' => 'left'
            ],
            'DEBIT_CODE' => [
                'value' => number_format($data->debit_code, 2),
                'align' => 'right'
            ],
            'CREDIT_CODE' => [
                'value' => number_format($data->credit_code, 2),
                'align' => 'right'
            ],
            'DEBIT_AMOUNT' => [
                'value' => number_format($data->debit_amount, 2),
                'align' => 'right'
            ],
            'CREDIT_AMOUNT' => [
                'value' => number_format($data->credit_amount, 2),
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