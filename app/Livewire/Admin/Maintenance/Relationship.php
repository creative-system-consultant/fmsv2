<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefRelationship;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Relationship extends Component
{
    use Actions, WithPagination;

    #[Rule('required|max:3|alpha')]
    public $code;

    #[Rule('required|string')]
    public $description;

    #[Rule('nullable|boolean')]
    public $status;

    public $openModal;
    public $title;
    public $method;
    public $relationship;
    public $coopId;

    public function openCreateModal()
    {
        $this->openModal = true;
        $this->title = "Create Relationship";
        $this->method = "create";
    }

    public function create()
    {
        $this->validate();

        $existedCode = RefRelationship::whereCoopId(auth()->user()->coop_id)->whereCode($this->code)->exists();

        if ($existedCode) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            RefRelationship::create([
                'code'            => trim(strtoupper($this->code)),
                'description'     => trim(strtoupper($this->description)),
                'coop_id'         => auth()->user()->coop_id,
                'status'          => $this->status == true ? '1' : '0',
                'created_at'      => now(),
                'created_by'      => auth()->user()->name,
            ]);

            $this->reset();
            $this->openModal = false;
        }
    }

    public function openUpdateModal($id)
    {
        $this->openModal = true;
        $this->title = "Update Relationship";
        $this->method = "update(" .$id. ")";
        $this->relationship = RefRelationship::find($id);

        $this->description = $this->relationship->description;
        $this->code = $this->relationship->code;
        $this->relationship->status == 1 ? $this->status = true : $this->status = false;
    }

    public function update($id)
    {
        $this->validate();

        $code = RefRelationship::find($id);
        $check = RefRelationship::whereCoopId(auth()->user()->coop_id)->whereCode($code->code);

        if ($check->exists() && $check->value('id') == $id) {
            RefRelationship::whereId($id)->update([
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
            'reject' => [
                'label'  => 'No, cancel',
                'method' => 'cancel',
            ],
        ]);
    }

    public function ConfirmDelete($id)
    {
        RefRelationship::whereId($id)->delete();
    }

    public function render()
    {
        $data = RefRelationship::whereCoopId(auth()->user()->coop_id)->paginate(10);

        return view('livewire.admin.maintenance.relationship', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
