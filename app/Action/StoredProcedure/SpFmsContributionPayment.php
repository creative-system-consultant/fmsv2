<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsContributionPayment
{
    public static function getRawData($input)
    {
        return DB::select("fms.up_rpt_contribution_payment :clientId, :startDate, :endDate", $input);   
    }
    public static function formatData($data)
    {
        return [
            'MEMBER NO' => [
                'value' => $data->mbr_no,
                'align' => 'left'
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
                'align' => 'right'
            ],
            'TRANSACTION' => [
                'value' => $data->transactions,
                'align' => 'right'
            ],
            'AMOUNT' => [
                'value' => number_format($data->amount, 2),
                'align' => 'right'
            ],
            'TRANSACTION DATE' => [
                'value' =>  date('Y-m-d', strtotime($data->transaction_date)) ?? 0,
                'align' => 'right'
            ],
            'DOCUMENT NO' => [
                'value' => $data->doc_no,
                'align' => 'right'
            ],
            'REMARKS' => [
                'value' => $data->remarks,
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