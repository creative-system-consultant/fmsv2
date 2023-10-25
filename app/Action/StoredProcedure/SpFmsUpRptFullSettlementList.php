<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptFullSettlementList
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_full_settlement_fin :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'NAME' => [
                'value' => $data->name,
                'align' => 'left'
            ],
            'MEMBERSHIP NO'   => [
                'value' => $data->mbr_no,
                'align' => 'left'
            ],
            'EMPLOYER'                  => [
                'value' => $data->current_employer_name,
                'align' => 'left'
            ],
            'ACCOUNT NO' => [
                'value' => $data->account_no,
                'align' => 'right'
            ],
            'EARLY SETTLEMENT' => [
                'value' => $data->early_settle_date,
                'align' => 'right'
            ],
            'PRODUCT' => [
                'value' => $data->product,
                'align' => 'left'
            ],
            'DIBURSEMENT AMOUNT' => [
                'value' => $data->disbursed_amount,
                'align' => 'right'
            ],
            'MODE' => [
                'value' => $data->mode,
                'align' => 'right'
            ],
            'AMOUNT SETTLEMENT' => [
                'value' => $data->amt_settlement,
                'align' => 'right'
            ],
            'PRINT AMOUNT' => [
                'value' => $data->prin_amt,
                'align' => 'right'
            ],
            'PROFIT AMOUNT' => [
                'value' => $data->profit_amt,
                'align' => 'right'
            ],
            'REBATE AMOUNT' => [
                'value' => $data->rebate_amount,
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