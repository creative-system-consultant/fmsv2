<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpUpRptMthFinancingPosition
{
    public static function getRawData($input)
    {
        return DB::select("rpt.up_rpt_mth_financing_position :clientId, :reportDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'Membership No'  => [
                'value' =>  $data->mbr_no,
                'align' => 'left'
            ],
            'Identity No'  => [
                'value' =>  $data->identity_no,
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
            'Product' => [
                'value' => $data->product,
                'align' => 'right'
            ],
            'Approved Limit' => [
                'value' => $data->approved_limit,
                'align' => 'right'
            ],
            'Approved Date' => [
                'value' => $data->date('d-m-Y', strtotime($data->approved_date)),
                'align' => 'right'
            ],
            'Selling Price' => [
                'value' => $data->selling_price,
                'align' => 'right'
            ],
            'Disbursement Amount' => [
                'value' =>$data->disbursed_amount,
                'align' => 'right'
            ],
            'Undrawn Amount' => [
                'value' =>$data->undrawn_amount,
                'align' => 'right'
            ],
            'Balance Outstanding'  => [
                'value' =>  $data->balance_outs,
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
            'Payment Amount' => [
                'value' => $data->payment_amount,
                'align' => 'right'
            ],
            'Total Profit Earned' => [
                'value' => $data->tot_profit_earned,
                'align' => 'right'
            ],
            'Princp Collected' => [
                'value' =>$data->princp_collected,
                'align' => 'right'
            ],
            'Advance Amount' => [
                'value' =>$data->number_format($data->advance_amt,2),
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
            'Credit Status' => [
                'value' =>$data->credit_status,
                'align' => 'right'
            ],
            'Npf Status' => [
                'value' =>$data->npf_status,
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