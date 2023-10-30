<?php

namespace App\Livewire\Teller\Autopay;

use App\Models\Fms\FmsAutopayToEmployer;
use Carbon\Carbon;
use Livewire\Attributes\Rule;
use App\Traits\Teller\Autopay\ListToEmployer;
use Livewire\Component;
use OpenSpout\Common\Entity\Style\CellAlignment;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

class ListingToEmployer extends Component
{
    use ListToEmployer;
    
    #[Rule('required')]
    public $month;

    #[Rule('required')]
    public $year;

    public function generateExcel()
    {
        $this->validate();

        $rawData = FmsAutopayToEmployer::whereMonth('REPORT_DATE', $this->month)
            ->whereYear('REPORT_DATE', $this->year)
            ->select('STAFFNO', 'MEMBERNO', 'NO_IC', 'NAME', 'AMOUNT', 'CODE')
            ->get();

        $columnMappings = [
            'STAFFNO' => 'Employee ID',
            'MEMBERNO' => 'Membership No',
            'NO_IC' => 'IC No',
            'NAME' => 'Name',
            'AMOUNT' => 'Amount',
            'CODE' => 'Code',
        ];

        $formattedData = $rawData->map(function ($item) use ($columnMappings) {
            foreach ($columnMappings as $originalColumn => $newColumn) {
                $item[$newColumn] = $item[$originalColumn];
                unset($item[$originalColumn]);
            }

            $item['Amount'] = number_format($item['Amount'], 2);
            return $item;
        });

        $dataGenerator = function () use ($formattedData) {
            foreach ($formattedData as $data) {
                yield $data;
            }
        };

        $filename = 'AutopayList %s %s.xlsx';
        $header_style = (new Style())->setFontBold()->setShouldWrapText(false);
        $rows_style = (new Style())->setShouldWrapText(false);
        $right_style = (new Style())->setCellAlignment(CellAlignment::RIGHT);

        $fileName = sprintf($filename, $this->month, $this->year);
        $data = $dataGenerator();
        $fastExcel = new FastExcel($data);

        return response()->streamDownload(function () use ($fastExcel, $header_style, $rows_style, $right_style) {
            return $fastExcel
                ->headerStyle($header_style)
                ->rowsStyle($rows_style)
                ->export('php://output');
        }, $fileName);
    }

    public function render()
    {
        $months = [];

        for ($i = 1; $i <= 12; $i++) {
            $monthDate = Carbon::create(null, $i, null);
            $months[] = [
                'value' => $i,
                'label' => $monthDate->format('F'),
            ];
        }

        $years = [];

        for ($year = Carbon::now()->year; $year >= 2021; $year--) {
            $years[] = $year;
        }

        return view('livewire.teller.autopay.listing-to-employer', [
            'months' => $months,
            'years' => $years
        ]);
    }
}
