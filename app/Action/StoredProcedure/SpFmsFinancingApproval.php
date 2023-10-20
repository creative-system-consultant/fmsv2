<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsFinancingApproval
{
    public static function getRawData($input)
{
    return DB::select("fms.up_rpt_financing_approval :clientId, :startDate, :endDate", $input);
}
    public static function formatData($data)
    {
        return [
            'MEMBERSHIP NO'  => [
                'value' =>  $data->mbr_no,
                'align' => 'right'
            ],
            'STAFF NO' => [
                'value' => $data->staff_no,
                'align' => 'right'
            ],
            'IDENTITY NO' => [
                'value' => $data->identity_no,
                'align' => 'right'
            ],
            'NAME' => [
                'value' => $data->name,
                'align' => 'left'
            ],
            'BRANCH CODE' => [
                'value' =>  $data->branch_code,
                'align' => 'right'
            ],
            'FINANCING_NAME' => [
                'value' => $data->financing_name,
                'align' => 'right'
            ],
            'APPLY_AMOUNT' => [
                'value' => number_format($data->apply_amount,2),
                'align' => 'right'
            ],
            'APPLY DATE' => [
                'value' => date('d-m-Y', strtotime($data->apply_date)),
                'align' => 'right'
            ],
            'APPROVED LIMIT'  => [
                'value' => number_format($data->approved_limit,2),
                'align' => 'right'
            ],
            'APPROVED DATE' => [
                'value' => date('d-m-Y', strtotime($data->approved_date)),
                'align' => 'left'
            ],
            'PROFIT RATE' => [
                'value' => $data->profit_rate,
                'align' => 'left'
            ],
            'DURATION'   => [
                'value' => $data->duration,
                'align' => 'left'
            ],
            'SELLING PRICE' => [
                'value' => number_format($data->selling_price,2),
                'align' => 'left'
            ],
            'INSTALL AMOUNT' => [
                'value' => number_format($data->instal_amount,2),
                'align' => 'left'
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

    public static function handleForExcel($rawData, $format = false)
    {
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