<?php

namespace App\Livewire\Report\Operation\GL;

use App\Action\StoredProcedure\SpFmsUpRptDetailGlByAccount;
use App\Models\Ref\RefGlcode;
use App\Services\General\ReportService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class DetailGlByAccount extends Component
{
    use Actions, WithPagination;

    public $clientId;

    #[Rule('required')]
    public $startDate;

    #[Rule('required')]
    public $endDate;

    #[Rule('required')]
    public $gl_code;

    public function mount()
    {
        $this->clientId = auth()->user()->client_id;
    }

    protected function getRawData()
    {
        return SpFmsUpRptDetailGlByAccount::getRawData([
            'clientId' => $this->clientId,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,
            'gl_code' => $this->gl_code,
        ], true);
    }

    public function generateExcel()
    {
        $this->validate();

        $rawData = $this->getRawData();

        if (count($rawData) > 0) {
            $formattedData = [];
            foreach ($rawData as $data) {
                $formattedData[] = SpFmsUpRptDetailGlByAccount::formatDataForExcel($data);
            }

            return $this->handleExcel($formattedData);
        } else {
            $this->dialog()->success('Process Complete!', 'No Data Found.');
        }
    }

    private function handleDataTable($rawData)
    {
        $data = SpFmsUpRptDetailGlByAccount::handleForTable($rawData, true);

        return ReportService::paginateData($data);
    }

    private function handleExcel($rawData)
    {
        $dataGenerator = function () use ($rawData) {
            foreach ($rawData as $data) {
                yield $data;
            }
        };

        $filename = 'Detail_Gl_ByAccount-%s.xlsx';
        $report = new ReportService();

        return $report->generateExcelReport($dataGenerator, $filename, $this->endDate);
    }
    public function render()
    {
        $result = null;

        if($this->startDate && $this->endDate) {
            $rawData = $this->getRawData();

            if(count($rawData) <= 1000) {
                $result = $this->handleDataTable($rawData);
            }
        }

        $gl_code = RefGlcode::select('id','GL_CODE','DESCRIPTION')->get()->toArray(); // This retrieves an array

        $allOption = [
            [
                'id' => 0,
                'GL_CODE' => 'ALL',
                'DESCRIPTION' => 'DESCRIPTION'
            ],
        ];

        $gl_code = array_merge($allOption, $gl_code);

        usort($gl_code, function ($a, $b) {
            return ($a['id'] - $b['GL_CODE']);
        });

        $gl_code = collect($gl_code);

        return view('livewire.report.operation.gl.detail-gl-by-account',[
            'result' => $result,
            'glc'=>$gl_code
        ])->extends('layouts.main');
    }
}