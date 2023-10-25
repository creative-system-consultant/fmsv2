<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptListFinancing
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_financing_all :clientId, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'MEMBERSHIP NO'   => [
                'value' => $data->mbr_no,
                'align' => 'left'
            ],
            'NAME' => [
                'value' => $data->name,
                'align' => 'left'
            ],
            'STAFF NO' => [
                'value' => $data->staff_no,
                'align' => 'left'
            ],
            'IDENTITY NO'  => [
                'value' => $data->identity_no,
                'align' => 'right'
            ],
            'EMAIL' => [
                'value' => $data->email,
                'align' => 'right'
            ],
            'PHONE (HOME)' => [
                'value' => $data->$data->resident_phone,
                'align' => 'right'
            ],
            'PHONE (MOBILE)' => [
                'value' => $data->phone,
                'align' => 'right'
            ],
            'RELIGION' => [
                'value' => $data->religion,
                'align' => 'right'
            ],
            'AGE' => [
                'value' => $data->age,
                'align' => 'right'
            ],
            'BIRTH DATE'                  => [
                'value' =>date('d-m-Y', strtotime($data->birth_date)),
                'align' => 'right'
            ],
            'CURRENT SALARY' => [
                'value' => number_format($data->current_salary,2),
                'align' => 'right'
            ],
            'STATE' => [
                'value' => $data->state,
                'align' => 'right'
            ],
            'OFFICE STATE' => [
                'value' => $data->office_state,
                'align' => 'right'
            ],
            'JOIN DATE' => [
                'value' => date('d-m-Y', strtotime($data->join_date)),
                'align' => 'right'
            ],
            'STATUS' => [
                'value' => $data->status,
                'align' => 'right'
            ],
            'MEMBER TYPE' => [
                'value' => $data->member_type,
                'align' => 'right'
            ],
            'JOB POSITION' => [
                'value' => $data->job_position,
                'align' => 'right'
            ],
            'RESCHEDULE' => [
                'value' => $data->reschedule,
                'align' => 'right'
            ],
            'TOTAL SHARE'=> [
                'value' => number_format($data->total_share,2),
                'align' => 'right'
            ],
            'TOTAL CONTRIBUTION' => [
                'value' => number_format($data->total_contribution,2),
                'align' => 'right'
            ],
            'MONTHLY CONTRIBUTION' => [
                'value' => number_format($data->monthly_contribution,2),
                'align' => 'right'
            ],
            'FINANCING ACCOUNT' => [
                'value' => $data->fin_count,
                'align' => 'right'
            ],
            'ACCOUNT NO' => [
                'value' => $data->account_no,
                'align' => 'right'
            ],
            'START DISBURSED DATE' => [
                'value' => date('d-m-Y', strtotime($data->start_disbursed_date)),
                'align' => 'right'
            ],
            'PAYROLL UNIT' => [
                'value' => $data->payroll_unit,
                'align' => 'right'
            ],
            'FINANCING NAME' => [
                'value' => $data->financing_name,
                'align' => 'right'
            ],
            'AMOUNT' => [
                'value' => $data->amount,
                'align' => 'right'
            ],
            'PROFIT RATE' => [
                'value' => $data->profit_rate,
                'align' => 'right'
            ],
            'TENURE' => [
                'value' => $data->tenure,
                'align' => 'right'
            ],
            'START INSTALLMENT DATE' => [
                'value' => $data->start_instal_date,
                'align' => 'right'
            ],
            'SETTLEMENT DATE' => [
                'value' => $data->date_of_settle,
                'align' => 'right'
            ],
            'SETTLEMENT YEAR' => [
                'value' => $data->settle_year,
                'align' => 'right'
            ],
            'INSTALLMENT AMOUNT' => [
                'value' => $data->instal_amount,
                'align' => 'right'
            ],
            'PRINCIPLE OUTSTANDING' => [
                'value' => $data->prin_outstanding,
                'align' => 'right'
            ],
            'UEI OUTSTANDING' => [
                'value' => $data->uei_outstanding,
                'align' => 'right'
            ],
            'BALANCE OUTSTANDING' => [
                'value' => $data->bal_outstanding,
                'align' => 'right'
            ],
            'FIRST TIME' => [
                'value' => $data->first_time,
                'align' => 'right'
            ],
            'FINANCING STATUS' => [
                'value' => $data->fin_status,
                'align' => 'right'
            ],
            'APPROVED DATE' => [
                'value' => $data->approved_date,
                'align' => 'right'
            ],
            'GUARANTOR 1 NAME' => [
                'value' => $data->Guarantor1,
                'align' => 'right'
            ],
            'GUARANTOR 1 IC NO' => [
                'value' => $data->Guarantor1_IcNo,
                'align' => 'right'
            ],
            'GUARANTOR 2 NAME' => [
                'value' => $data->Guarantor2,
                'align' => 'right'
            ],
            'GUARANTOR 2 IC NO' => [
                'value' => $data->Guarantor2_IcNo,
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