<?php

namespace App\Livewire\Report\Operation\GL;

use App\Action\StoredProcedure\SpFmsUpRptDetailGl;
use App\Models\Fms\FmsTrxGlMap;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class DetailGl extends Component
{
    use Actions, WithPagination;

    public $clientId;

    #[Rule('required')]
    public $reportDate;

    #[Rule('required')]
    public $gl_desc;

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
    }

    protected function getRawData()
    {
        return SpFmsUpRptDetailGl::getRawData([
            'clientId' => $this->clientId,
            'reportDate' => $this->reportDate,
            'gl_desc' => $this->gl_desc,
        ], true);
    }

    public function generateExcel()
    {
        $this->validate();

        $rawData = $this->getRawData();

        if (count($rawData) > 0) {
            $formattedData = [];
            foreach ($rawData as $data) {
                $formattedData[] = SpFmsUpRptDetailGl::formatDataForExcel($data);
            }

            return $this->handleExcel($formattedData);
        } else {
            $this->dialog()->success('Process Complete!', 'No Data Found.');
        }
    }

    private function handleDataTable($rawData)
    {
        $data = SpFmsUpRptDetailGl::handleForTable($rawData, true);

        return ReportService::paginateData($data);
    }

    private function handleExcel($rawData)
    {
        $dataGenerator = function () use ($rawData) {
            foreach ($rawData as $data) {
                yield $data;
            }
        };

        $filename = 'GL_Detail_%s.xlsx';
        $report = new ReportService();

        return $report->generateExcelReport($dataGenerator, $filename, $this->reportDate);
    }

    public function render()
    {
        $result = null;

        if($this->reportDate) {
            $rawData = $this->getRawData();

            if(count($rawData) <= 1000) {
                $result = $this->handleDataTable($rawData);
            }
        }

        $gl_desc = FmsTrxGlMap::select('id','gl_acctg_desc')->get()->toArray(); // This retrieves an array

        $allOption = [
            [
                'id' => 0,
                'gl_acctg_desc' => 'ALL'
            ],
        ];

        $gl_desc = array_merge($allOption, $gl_desc);

        usort($gl_desc, function ($a, $b) {
            return $a['id'] - $b['id'];
        });

        $gl_desc = collect($gl_desc);

        return view('livewire.report.operation.gl.detail-gl',[
            'result' => $result,
            'gl_descs'=>$gl_desc
        ])->extends('layouts.main');
    }
}
