<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsFinancingDisbursement
{
    public static function getRawData($input)
    {
        return DB::select("fms.up_rpt_fin_disbursement :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'MEMBER ID' => [
                'value' => $data->member_id,
                'align' => 'left'
            ],
            'NAME' => [
                'value' => $data->name,
                'align' => 'right'
            ],
            'PAYROLL UNIT' => [
                'value' => $data->payroll_unit ?? 0,
                'align' => 'right'
            ],
            
            'SALARY' => [
                'value' => is_numeric($data->salary) ? number_format($data->salary, 2) : $data->salary,
                'align' => 'right'
            ],

            'DEDUCTION' => [
                'value' => is_numeric($data->deduction) ? number_format($data->deduction, 2) : $data->deduction,
                'align' => 'right'
            ],
            'LOAN TYPE' => [
                'value' => $data->loan_type,
                'align' => 'right'
            ],
            'DISBURSED DATE' => [
                'value' => date('Y-m-d'), 
                'align' => 'right'
            ],
            'RATE' => [
                'value' => number_format($data->rate, 2),
                'align' => 'right'
            ],
            'DISBURSED AMOUNT' => [
                'value' => is_numeric($data->disbursed_amount) ? number_format($data->disbursed_amount, 2) : $data->disbursed_amount,
                'align' => 'right'
            ],
            'SETTLE PROFIT' => [
                'value' => is_numeric($data->settle_profit) ? number_format($data->settle_profit, 2) : $data->settle_profit,
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