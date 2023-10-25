<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsRptListDividendPayment
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_members_bystate :clientId, :startDate, :endDate, :flag, :batchNo", $input);
    }

    public static function formatData($data)
    {
        return [
            'BATCH NO' => [
                'value' => $data->batch_no,
                'align' => 'right'
            ],
            'MEMBER NO'  => [
                'value' =>  $data->mbr_no,
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
            'TOTAL SHARE' => [
                'value' => number_format($data->tot_share,2),
                'align' => 'right'
            ],
            'TOTAL CONTRIBUTION' => [
                'value' => number_format($data->tot_contribution,2),
                'align' => 'right'
            ],
            'TOTAL DIVIDEND' => [
                'value' => $data->tot_div,
                'align' => 'right'
            ],
            'TABUNG KHIRAT' => [
                'value' =>  $data->tabung_khirat,
                'align' => 'right'
            ],
            'TOTAL WITHDRAWAL'  => [
                'value' => $data->total_withdrawal,
                'align' => 'right'
            ],
            'BALANCE DIVIDEND' => [
                'value' => $data->bal_dividen,
                'align' => 'left'
            ],
            'BALANCE OUTSTANDING TABUNG KHIRAT' => [
                'value' => $data->outs_bal_tbg_khirat,
                'align' => 'left'
            ],
            'DATE PAYMENT'   => [
                'value' => $data->payment_dt,
                'align' => 'left'
            ],
            'PAYMENT INFO' => [
                'value' => $data->payment_info,
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