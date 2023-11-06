<?php

namespace App\Livewire\Finance\Category\Info;

use App\Models\Fms\FmsAccountMaster;
use Carbon\Carbon;
use Livewire\Component;

class EarlySettlement extends Component
{
    public $uuid, $settlement, $account, $position, $schedule, $settlementAmount, $rebateAmount,
        $profitAmount, $settlementDate, $confirmed = false, $calculated = false, $flag_rebate,
        $rebate_amt1, $bal_outstanding, $rebate_amount = false;
    public $clientID;

    public function mount()
    {
        $this->clientID = auth()->user()->client_id;

        $this->settlement = null;
        $this->account = FmsAccountMaster::where('uuid', $this->uuid)->first();
        $this->schedule = new \App\Models\Fms\FmsRepaymentSchedule();
        $this->confirmed = is_null($this->account->early_settle_date) ? false : true;

        $instalmentNo = $this->account->position->instalment_no + 1;
        $this->schedule = $this->account->repayment_schedule($this->clientID)->where('instalment_no', $instalmentNo)->first();

        $this->settlementDate = optional($this->account->early_settle_date)->format('Y-m-d');
        $this->rebateAmount = $this->account->rebate_amt;
        $this->settlementAmount = $this->account->settle_amt;
        $this->profitAmount = $this->profitAmount = optional($this->schedule)->profit_amt;
    }

    public function rebateAmountCheck()
    {
        $this->rebate_amount = !$this->rebate_amount;

        if ($this->rebate_amount == true) {
            $this->rebate_amt1 = 0;
        } else {
            $this->rebate_amt1 = 0;
        }
    }

    public function calculate()
    {

        $this->settlementDate = Carbon::now()->endOfMonth()->format('Y-m-d');



        if ($this->flag_rebate = 1 && $this->rebate_amt1 <> null) {
            $this->profitAmount = ($this->account->position->bal_outstanding - $this->account->position->prin_outstanding - $this->rebate_amt1);
            $this->settlementAmount = ($this->account->position->prin_outstanding + ($this->account->position->bal_outstanding - $this->account->position->prin_outstanding - $this->rebate_amt1));
            $this->rebateAmount = $this->rebate_amt1;
        } else {
            if ($this->account->position->uei_outstanding > 0) {
                if ($this->account->position->uei_outstanding < optional($this->account)->instal_amount) {
                    $this->profitAmount = optional($this->account->position)->uei_outstanding;
                    $this->settlementAmount = optional($this->account->position)->bal_outstanding;
                    $this->rebateAmount = 0.00;
                } else {
                    $this->settlementAmount = ($this->account->position->prin_outstanding + optional($this->account)->instal_amount + $this->account->position->income_arrears);
                    $this->profitAmount = optional($this->account)->instal_amount + $this->account->position->income_arrears;

                    //new rules added as at 18/09/2023
                    if ($this->profitAmount > $this->account->position->uei_outstanding) {
                        $this->profitAmount = $this->account->position->uei_outstanding;
                    } else {
                        $this->profitAmount = $this->profitAmount;
                    }
                    $this->rebateAmount = optional($this->account->position)->bal_outstanding - $this->settlementAmount;
                }
            } else {
                $this->settlementAmount = ($this->account->position->prin_outstanding + $this->account->position->income_arrears);
                $this->profitAmount = 0.00;
            }
        }
        $this->calculated = true;
    }

    public function confirmation()
    {
        $this->account->early_settle_date = $this->settlementDate;
        $this->account->early_settle_notice_date = Carbon::now();
        $this->account->rebate_amt = $this->rebateAmount;
        $this->account->settle_amt = $this->settlementAmount;
        $this->account->settle_profit = $this->profitAmount;
        $this->account->flag_rebate = $this->flag_rebate;
        $this->account->save();
        $this->confirmed = true;

        // $this->dispatchBrowserEvent('swal',[
        //     'title' => 'Success!',
        //     'text'  => 'The transaction have been recorded.',
        //     'icon'  => 'success',
        //     'showConfirmButton' => false,
        //     'timer' => 1500,
        // ]);

    }

    public function render()
    {
        return view('livewire.finance.category.info.early-settlement', [
            'accountPosition' => $this->account->position
        ]);
    }
}
