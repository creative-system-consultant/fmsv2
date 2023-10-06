<?php

namespace App\Services\General;

class PopupService
{
    public function __construct()
    {
        //
    }

    public function confirm($component, $confirmMethod, $title = 'Confirmation', $description = 'Are you sure?')
    {
        $component->dialog()->confirm([
            'title'       => $title,
            'description' => $description,
            'acceptLabel' => 'Yes, proceed',
            'method'      => $confirmMethod,
        ]);
    }
}