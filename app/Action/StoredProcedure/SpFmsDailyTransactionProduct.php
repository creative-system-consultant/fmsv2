<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsDailyTransactionProduct
{
    public static function getRawData($input)
    {
        return DB::select("FMS.up_rpt_daily_trx_products :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'PRODUCT' => [
                'value' => $data->product,
                'align' => 'left'
            ],
            'BIL APPLY' => [
                'value' => $data->bil_apply ?? 0,
                'align' => 'right'
            ],
            'APPLY AMOUNT' => [
                'value' => number_format($data->apply_amount, 2),
                'align' => 'right'
            ],
            'BIL REJECTED' => [
                'value' => $data->bil_rejected ?? 0,
                'align' => 'right'
            ],
            'REJECTED' => [
                'value' => number_format($data->rejected, 2),
                'align' => 'right'
            ],
            'BIL APPROVED' => [
                'value' => $data->bil_approved ?? 0,
                'align' => 'right'
            ],
            'APPROVED LIMIT' => [
                'value' => number_format($data->approved_limit, 2),
                'align' => 'right'
            ],
            'BIL DISB' => [
                'value' => $data->bil_disb ?? 0,
                'align' => 'right'
            ],
            'DISBURSEMENT AMOUNT' => [
                'value' => number_format($data->disbursed_amount, 2),
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

    public static function handleForTable($input, $format = false)
    {
        $rawData = self::getRawData($input);
        $formattedData = [];
        foreach ($rawData as $data) {
            $formattedData[] = $format ? self::formatData($data) : $data;
        }
        return new Collection($formattedData);
    }
}