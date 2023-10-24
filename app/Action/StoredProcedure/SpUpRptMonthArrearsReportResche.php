<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpUpRptMonthArrearsReportResche
{
    public static function getRawData($input)
    {
        return DB::select("fms.UP_RPT_MONTH_ARREARS_REPORT_RESCHE :clientId, :reportDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'Membership No'  => [
                'value' =>  $data->mbr_no,
                'align' => 'left'
            ],
            'Name' => [
                'value' => $data->name,
                'align' => 'right'
            ],
            'Account No' => [
                'value' => $data->account_no,
                'align' => 'right'
            ],
            'Balance Outstanding'  => [
                'value' =>  $data->bal_outstanding,
                'align' => 'left'
            ],
            'Prin Outstanding'  => [
                'value' =>  $data->prin_outstanding,
                'align' => 'left'
            ], 
            'Uei Outstanding' => [
                'value' => $data->uei_outstanding,
                'align' => 'right'
            ],
            'Month Arrears' => [
                'value' =>$data->month_arrears,
                'align' => 'right'
            ],
            'Instal Arrears' => [
                'value' =>$data->instal_arrears,
                'align' => 'right'
            ],
            'Payment Type' => [
                'value' =>$data->payment_type,
                'align' => 'right'
            ],
            'Npf Status' => [
                'value' =>$data->npf_status,
                'align' => 'right'
            ],
            'Product' => [
                'value' =>$data->product,
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