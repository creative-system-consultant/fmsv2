<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefReligion;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Religion extends Component
{
    use Actions, WithPagination;

    #[Rule('required|string')]
    public $description;

    #[Rule('required|max:3|alpha')]
    public $code;

    #[Rule('nullable|boolean')]
    public $status;

    public $openModal;
    public $title;
    public $method;
    public $religion;

    public function openCreateModal()
    {
        $this->openModal = true;
        $this->title = "Create Religion";
        $this->method = "create";
    }

    public function create()
    {
        $this->validate();

        $existedCode = RefReligion::whereCoopId(auth()->user()->coop_id)->whereCode($this->code)->exists();

        if ($existedCode) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            RefReligion::create([
                'description'     => trim(strtoupper($this->description)),
                'code'            => trim(strtoupper($this->code)),
                'coop_id'         => auth()->user()->coop_id,
                'status'          => $this->status == true ? '1' : '0',
                'created_at'      => now(),
                'created_by'      => auth()->user()->name,
            ]);

            // clear input field
            $this->reset();
            // close modal
            $this->openModal = false;
        }
    }

    public function openUpdateModal($id)
    {
        $this->openModal = true;
        $this->title = "Update Religion";
        $this->method = "update(" .$id. ")";
        $this->religion = RefReligion::find($id);

        $this->description = $this->religion->description;
        $this->code = $this->religion->code;
        $this->religion->status == 1 ? $this->status = true : $this->status = false;
    }

    public function update($id)
    {
        $this->validate();

        $code = RefReligion::find($id);
        $check = RefReligion::whereCoopId(auth()->user()->coop_id)->whereCode($code->code);

        if ($check->exists() && $check->value('id') == $id) {
            RefReligion::whereId($id)->update([
                'description'     => trim(strtoupper($this->description)),
                'code'            => trim(strtoupper($this->code)),
                'status'          => $this->status == true ? '1' : '0',
                'updated_at'      => now(),
                'updated_by'      => auth()->user()->name,
            ]);

            $this->openModal = false;
        } else {
            $this->addError('code', 'The code has already been taken.');
        }
    }

    public function delete($id)
    {
        $this->dialog()->confirm([
            'title'       => 'Are you Sure?',
            'description' => 'Delete the information?',
            'icon'        => 'question',
            'accept'      => [
                'label'  => 'Yes, delete it',
                'method' => 'ConfirmDelete',
                'params' => $id,
            ],
            'reject' =>
            [
                'label'  => 'No, cancel',
                'method' => 'cancel',
            ],
        ]);
    }

    public function ConfirmDelete($id)
    {
        RefReligion::whereId($id)->delete();
    }

    public function render()
    {
        $data = RefReligion::whereCoopId(auth()->user()->coop_id)->paginate(10);

        return view('livewire.admin.maintenance.religion', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
