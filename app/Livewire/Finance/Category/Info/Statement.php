<?php

namespace App\Livewire\Finance\Category\Info;

use App\Models\Fms\FmsAccountMaster;
use App\Models\Fms\FmsAccountStatement;
use DB;
use Livewire\Component;
use Livewire\WithPagination;
use OpenSpout\Common\Entity\Style\Style;
use Rap2hpoutre\FastExcel\FastExcel;

class Statement extends Component
{
    use WithPagination;

    public $uuid;
    public $startDate, $endDate, $account;

    public function mount()
    {
        $this->startDate    =  '2021-12-31';
        $this->endDate      =  now()->format('Y-m-d');
        $this->account = FmsAccountMaster::where('uuid', '=', $this->uuid)->orderby('id', 'desc')->first();
    }

    public function renderReportList()
    {
        $stmt = FmsAccountStatement::select(
            DB::raw("FMS.uf_get_users_name(client_id, created_by) AS user_name"),
            '*'
        )
            ->where('account_no', $this->account->account_no)
            ->whereBetween(DB::raw('cast(transaction_date as date)'), [$this->startDate, $this->endDate])
            ->orderBy('id')->get();
        foreach ($stmt as $item) {
            yield $item;
        }
    }

    public function generateExcel()
    {

        return response()->streamDownload(function () {
            $header_style = (new Style())->setFontBold();
            $rows_style = (new Style())->setShouldWrapText(false);
            (new FastExcel($this->renderReportList()))
                ->headerStyle($header_style)
                ->rowsStyle($rows_style)
                ->export('php://output', function ($item) {
                    return [
                        'TRANSACTION DATE'          => date('d-m-Y', strtotime($item->transaction_date)),
                        'DOC NO'                    => $item->doc_no,
                        'TRANSACTION DESCRIPTION'   => ($item->transaction_code ? $item->transaction_code->description : 'N/A'),
                        'REMARKS'                   => ($item->remarks ? $item->remarks : 'N/A'),
                        'AMOUNT'                    => $item->amount,
                        'BAL OUTS'                  => $item->stmt_balance,
                        'PRINCIPAL'                 => $item->princp_outs,
                        'PROFIT'                    => $item->profit,
                        'UEI OUTS'                  => $item->unearned_outs,
                        'ADV PAYMENT'               => $item->advance_payment,
                        'CREATED BY'                => $item->created_by,
                        'CREATED AT'                => date('d/m/Y', strtotime($item->created_at)),
                    ];
                });
        }, sprintf('Statement-%s.xlsx', now()->format('Y-m-d')));
    }

    public function render()
    {
        $stmt = FmsAccountStatement::select(
            DB::raw("FMS.uf_get_users_name(client_id, created_by) AS user_name"),
            '*'
        )
            ->where('account_no', $this->account->account_no)
            ->whereBetween(DB::raw('cast(transaction_date as date)'), [$this->startDate, $this->endDate])
            ->orderBy('id')
            // ->get();
            ->paginate(10);

        // dump($account->account_no);



        $account_stmt = FmsAccountMaster::where('uuid', '=', $this->uuid)->first();

        return view('livewire.finance.category.info.statement', [
            'statements' => $stmt,
            'account_stmt' => $account_stmt
        ]);
    }
}
