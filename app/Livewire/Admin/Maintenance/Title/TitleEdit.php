<?php

namespace App\Livewire\Admin\Maintenance\Title;

use Livewire\Component;
use App\Models\Ref\RefTitle;
use App\Models\User;
use WireUi\Traits\Actions;

class TitleEdit extends Component
{
    use Actions;
    public $description;
    public $code;
    public $status;
    public $RefTitle;

    protected $rules =[
        'description' => ['required', 'string'],
        'code'        => ['required', 'alpha'],
        'status' => ['nullable','boolean'],
    ];
    

    public function cancel() {
        return redirect()->route('title.list');
    }

    public function update($id)
    {
        $this->validate();

        $User = User::find(auth()->user()->id);

        $check = RefTitle::where('coop_id',$User->coop_id)->where('code',$this->code);

        if($check->exists() == false || $check->value('id') == $id)
        {
            $title = RefTitle::where('id', $id)->first();

            RefTitle::whereId($id)->update([
                'description'     => trim(strtoupper($this->description)),
                'code'            => trim(strtoupper($this->code)),
                'status'          => $this->status == true ? '1' : '0',
                'updated_at'      => now(),
                'updated_by'      => Auth()->user()->name,
            ]);
            return redirect()->route('title.list');
        }
       else
       {
            $this->dialog([

                'title'       => 'Error!',

                'description' => 'Code Already Exists',

                'icon'        => 'error'

            ]);
        }
    }
    

    public function mount($id)
    {
        $this->RefTitle = RefTitle::find($id);
        $this->code = $this->RefTitle->code;
        $this->description = $this->RefTitle->description;
        $this->status = $this->RefTitle->status == 1 ? true:false;
    }

    public function render()
    {
        return view('livewire.admin.maintenance.title.title-edit')->extends('layouts.main');
    }
}
