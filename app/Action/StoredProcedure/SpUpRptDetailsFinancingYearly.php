<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpUpRptDetailsFinancingYearly
{
    public static function getRawData($input)
    {
        return DB::select("RPT.UP_RPT_DETAILS_FINANCING_YEARLY :clientId, :reportDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'Membership No'  => [
                'value' =>  $data->membership_no,
                'align' => 'left'
            ],
            'Identity No' => [
                'value' => $data->identity_no,
                'align' => 'right'
            ],
            'Name' => [
                'value' => $data->name,
                'align' => 'right'
            ],
            'Account No' => [
                'value' => $data->account_no,
                'align' => 'right'
            ],
            'Product' => [
                'value' =>$data->product,
                'align' => 'right'
            ],
            'Opening Principal'    => [
                'value' => number_format($data->opening_principal,2),
                'align' => 'right'
            ],
            'Opening Profit'    => [
                'value' => number_format($data->opening_profit,2),
                'align' => 'right'
            ],
            'Disbursed Principal'    => [
                'value' => number_format($data->disbursed_principal,2),
                'align' => 'right'
            ],
            'Disbursed Profit'    => [
                'value' => number_format($data->disbursed_profit,2),
                'align' => 'right'
            ],
            'Transaction Principal'    => [
                'value' => number_format($data->transaction_principal,2),
                'align' => 'right'
            ],
            'Transaction Profit'    => [
                'value' => number_format($data->transaction_profit,2),
                'align' => 'right'
            ],
            'Transaction Rebate'    => [
                'value' => number_format($data->transaction_rebate,2),
                'align' => 'right'
            ],
            'Adjustment Principal'    => [
                'value' => number_format($data->adjustment_principal,2),
                'align' => 'right'
            ],
            'Adjustment Profit'    => [
                'value' => number_format($data->adjustment_profit,2),
                'align' => 'right'
            ],
            'Closing Principal'    => [
                'value' => number_format($data->closing_principal,2),
                'align' => 'right'
            ],
            'Closing Profit'    => [
                'value' => number_format($data->closing_profit,2),
                'align' => 'right'
            ],
            'Total Advance'    => [
                'value' => number_format($data->total_advance,2),
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