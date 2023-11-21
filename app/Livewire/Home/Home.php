<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Models\Ref\RefBank;
use App\Models\User;
use App\Models\Fms\FmsMembership;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\WithPagination;
use WireUi\Traits\Actions;
use Illuminate\Support\Facades\DB;

class Home extends Component
{
    use WithPagination;
    use Actions;

    public $selectClientModal = false;

    #[Rule('required')]
    public $client;

    public function mount()
    {
        if (session('just_logged_in') && auth()->user()->clients->count() > 1) {
            $this->selectClientModal = true;
            session()->forget('just_logged_in');
        } else {
            $this->selectClientModal = false;
        }
    }

    public function saveClient()
    {
        $this->validate();

        User::whereId(auth()->id())->update(['client_id' => $this->client]);
        $this->selectClientModal = false;

        // dispatch an event
        $this->dispatch('clientUpdated');
        return $this->redirect('/home', navigate: true);
    }

    public function render()
    {
        $clientType = User::where('client_id', auth()->user()->client_id)
            ->where('user_type', 2)
            ->first();

        $disb =  DB::table('FMS.ACCOUNT_MASTERS AS A')
                    ->join('FMS.ACCOUNT_POSITIONS AS B', 'A.account_no', '=', 'B.account_no')
                    ->join('FMS.MEMBERSHIP AS C', 'A.mbr_no', '=', 'C.mbr_no')
                    ->join('CIF.CUSTOMERS AS D', 'C.cif_id', '=', 'D.ID')
                    ->select(
                        'C.mbr_no',
                        'D.name',
                        'A.ACCOUNT_NO',
                        'B.disbursed_amount',
                        'B.prin_outstanding',
                        'B.uei_outstanding'
                    )
                    ->whereNotNull('A.pre_disbursement_flag')
                    ->where('C.status_id', '=', 1)
                    ->where('A.account_status', '=', 1)
                    ->where('B.client_id', '=', auth()->user()->client_id)
                    ->where('C.client_id', '=', auth()->user()->client_id)
                    // ->where('D.client_id', '=', auth()->user()->client_id)
                    ->paginate(3);

        $preDisb  =  DB::table('FMS.ACCOUNT_MASTERS AS A')
                        ->join('FMS.ACCOUNT_POSITIONS AS B', 'A.account_no', '=', 'B.account_no')
                        ->join('FMS.MEMBERSHIP AS C', 'A.mbr_no', '=', 'C.mbr_no')
                        ->join('CIF.CUSTOMERS AS D', 'C.cif_id', '=', 'D.ID')
                        ->select(
                            'C.mbr_no',
                            'D.name',
                            'A.ACCOUNT_NO',
                            'B.disbursed_amount',
                            'B.prin_outstanding',
                            'B.uei_outstanding'
                        )
                        ->whereNull('A.pre_disbursement_flag')
                        ->where('C.status_id', '=', 1)
                        ->where('A.account_status', '=', 1)
                        ->where('B.client_id', '=', auth()->user()->client_id)
                        ->where('C.client_id', '=', auth()->user()->client_id)
                        // ->where('D.client_id', '=', auth()->user()->client_id)
                        ->paginate(3);

        $activeMember = FmsMembership::where('client_id' , auth()->user()->client_id)->where('status_id' , 1)->paginate(3);
        $closeMember  = FmsMembership::where('client_id' , auth()->user()->client_id)->where('status_id' , 4)->paginate(3);

        return view('livewire.home.home',[
            'activeMember' => $activeMember,
            'closeMember' => $closeMember,
            'disb' => $disb,
            'preDisb' => $preDisb,
            'clients' => auth()->user()->clients,
            'clientType' => $clientType->roles->first()->name,
        ])->extends('layouts.main');
    }
}
