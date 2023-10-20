<?php

namespace App\Action\StoredProcedure;
use Illuminate\Support\Collection;

use DB;

class SpFmsUpRptMemberNotPayContribution
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_members_not_pay_contribution :clientId, :reportDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'Staff No'  => [
                'value' =>  $data->staff_no,
                'align' => 'left'
            ],
            'Member No'  => [
                'value' =>  $data->mbr_no,
                'align' => 'left'
            ],
            'IC No'  => [
                'value' =>  $data->ic,
                'align' => 'left'
            ],
            'Name' => [
                'value' => $data->name,
                'align' => 'left'
            ],
            'Monthly Contribution' => [
                'value' =>number_format($data->monthly_contribution,2),
                'align' => 'left'
            ],
            'Transaction Date'  => [
                'value' => date('d-m-Y', strtotime($data->transaction_date)),
                'align' => 'right'
            ],
            'Last Pay Date'  => [
                'value' =>date('d-m-Y', strtotime($data->last_pay_date)),
                'align' => 'right'
            ],
            'Amount' => [
                'value' =>number_format($data->amount,2),
                'align' => 'right'
            ],
            'Total Contribution' => [
                'value' =>number_format($data->total_contribution,2),
                'align' => 'left'
            ],
            'Total Share' => [
                'value' =>number_format($data->total_share,2),
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
