<?php

namespace App\Services\General;

use Illuminate\Pagination\LengthAwarePaginator;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

class ReportService
{
    public static function paginateData($data, $perPage = 10)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $currentPageData = $data->slice(($currentPage * $perPage) - $perPage, $perPage)->all();
        $finalResultData = new LengthAwarePaginator($currentPageData, count($data), $perPage);
        $finalResultData->setPath(LengthAwarePaginator::resolveCurrentPath());

        return $finalResultData;
    }

    public function generateExcelReport($data, $filename, $startDate)
    {
        $header_style = (new Style())->setFontBold()->setShouldWrapText(false);
        $rows_style = (new Style())->setShouldWrapText(false);
        $right_style = (new Style())->setCellAlignment(CellAlignment::RIGHT);
        $fileName = sprintf($filename, $startDate);
        $fastExcel = new FastExcel($data);

        return response()->streamDownload(function () use ($fastExcel, $header_style, $rows_style, $right_style) {
            return $fastExcel
                ->headerStyle($header_style)
                ->rowsStyle($rows_style)
                ->export('php://output');
        }, $fileName);
    }
}