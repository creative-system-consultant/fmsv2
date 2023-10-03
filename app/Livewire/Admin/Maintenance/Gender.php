<?php

namespace App\Livewire\Admin\Maintenance;

use App\Models\Ref\RefGender;
use App\Services\Maintenance\GenderService;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class Gender extends Component
{
    use Actions, WithPagination;

    #[Rule('required|max:3|alpha')]
    public $code;

    #[Rule('required|string')]
    public $description;

    #[Rule('nullable|boolean')]
    public $status;

    public $openModal;
    public $modalTitle;
    public $modalDescription;
    public $modalMethod;
    public $gender;
    public $coopId;
    public $paginated;

    protected $genderService;

    public function __construct()
    {
        $this->genderService = new GenderService();
    }

    private function setupModal($method, $title, $description, $actualMethod = null)
    {
        $this->openModal = true;
        $this->modalTitle = $title;
        $this->modalDescription = $description;
        $this->modalMethod = $actualMethod ?? $method;
    }

    public function openCreateModal()
    {
        $this->setupModal("create", "Create Gender", "Gender");
    }

    public function create()
    {
        $this->validate();

        if ($this->genderService->isCodeExists($this->code)) {
            $this->addError('code', 'The code has already been taken.');
        } else {
            $this->genderService->createGender($this->description, $this->code, $this->status);
            $this->reset();
            $this->openModal = false;
        }
    }

    public function render()
    {
        $data = $this->genderService->getPaginatedGender($this->paginated);

        return view('livewire.admin.maintenance.gender', [
            'data' => $data,
        ])->extends('layouts.main');
    }
}
