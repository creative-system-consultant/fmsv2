<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptDeductionList
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_list_of_deduction :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'MEMBERSHIP NO'   => [
                'value' => $data->MBR_NO,
                'align' => 'left'
            ],
            'ID' => [
                'value' => $data->ID,
                'align' => 'left'
            ],
            'TRANSACTIONS'   => [
                'value' => $data->TRANSACTIONS,
                'align' => 'left'
            ],
            'NAME'                  => [
                'value' => $data->NAME,
                'align' => 'left'
            ],
            'MODE' => [
                'value' => $data->MODE,
                'align' => 'right'
            ],
            'DISBURSED AMOUNT' => [
                'value' => $data->disbursed_amount,
                'align' => 'right'
            ],
            'DEBIT' => [
                'value' => $data->DEBIT,
                'align' => 'right'
            ],
            'CREDIT' => [
                'value' => $data->CREDIT,
                'align' => 'right'
            ],
            'DATE' => [
                'value' => $data->DATE,
                'align' => 'right'
            ],
            'PRODUCT' => [
                'value' => $data->PRODUCT,
                'align' => 'left'
            ],
            'START DISBURSED DATE' => [
                'value' => $data->start_disbursed_date,
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