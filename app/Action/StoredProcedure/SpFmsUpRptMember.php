<?php

namespace App\Action\StoredProcedure;

use DB;
use Illuminate\Support\Collection;

class SpFmsUpRptMember
{
    public static function getRawData($input)
    {
        return DB::select("RPT.up_rpt_all_members :clientId, :startDate, :endDate", $input);
    }

    public static function formatData($data)
    {
        return [
            'Membership No'  => [
                'value' =>  $data->mbr_no,
                'align' => 'left'
            ],
            'Name' => [
                'value' => $data->name,
                'align' => 'right'
            ],
            'Identity No' => [
                'value' => $data->identity_no,
                'align' => 'right'
            ],
            'Staff No' => [
                'value' =>  $data->staff_no,
                'align' => 'right'
            ],
            'Email' => [
                'value' =>$data->email,
                'align' => 'right'
            ],
            'Race' => [
                'value' => $data->race_id,
                'align' => 'right'
            ],
            'Religion' => [
                'value' =>  $data->religion_id,
                'align' => 'right'
            ],
            'Job Position'  => [
                'value' => $data->job_position,
                'align' => 'right'
            ],
            'Payroll Unit' => [
                'value' => $data->current_employer_name,
                'align' => 'right'
            ],
            'Company Address' => [
                'value' => $data->company_address,
                'align' => 'right'
            ],
            'Company Phone No'   => [
                'value' => $data->company_phone_no,
                'align' => 'right'
            ],
            'Employment Date'     => [
                'value' => date('d-m-Y', strtotime($data->current_employment_date)),
                'align' => 'right'
            ],
            'Salary'  => [
                'value' =>number_format($data->current_salary,2),
                'align' => 'right'
            ],
            'Approve Retirement Date'  => [
                'value' => date('d-m-Y', strtotime($data->approved_retirement_date)),
                'align' => 'right'
            ],
            'Effective Retirement Date'   => [
                'value' => date('d-m-Y', strtotime($data->effective_retirement_date)),
                'align' => 'right'
            ],
            'Date Joined'   => [
                'value' => date('d-m-Y', strtotime($data->start_date)),
                'align' => 'right'
            ],
            'Total Share'    => [
                'value' => number_format($data->total_share,2),
                'align' => 'right'
            ],
            'Total Contribution'   => [
                'value' => number_format($data->total_contribution,2),
                'align' => 'right'
            ],
            'Monthly Contribution'   => [
                'value' => number_format($data->monthly_contribution,2),
                'align' => 'right'
            ],
            'Gender'   => [
                'value' => $data->gender_id,
                'align' => 'right'
            ],
            'Mobile Phone'   => [
                'value' => $data->phone,
                'align' => 'right'
            ],
            'Address'  => [
                'value' =>$data->add1,
                'align' => 'right'
            ],
            'Gender'   => [
                'value' => $data->gender_id,
                'align' => 'right'
            ],
            'Spouse'    => [
                'value' => $data->spounse_name,
                'align' => 'right'
            ],
            'Marital Status'   => [
                'value' =>  $data->marital_id,
                'align' => 'right'
            ],
            'Status'    => [
                'value' => $data->status_id,
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