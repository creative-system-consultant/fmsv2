<?php

namespace App\Services\General;

/**
 * Service class for handling popup-based operations.
 */
class PopupService
{
    /**
     * Displays a confirmation dialog to the user using the given component's dialog method.
     *
     * @param object $component      The Livewire component that will be used to render the dialog.
     * @param string $confirmMethod  The method to be called on the Livewire component upon confirmation.
     * @param string $title          The title for the confirmation dialog. Defaults to 'Confirmation'.
     * @param string $description    The description or question for the confirmation dialog. Defaults to 'Are you sure?'.
     * @param mixed  $params         Additional parameters that can be passed to the dialog. Default is an empty string.
     */
    public static function confirm($component, $confirmMethod, $title = 'Confirmation', $description = 'Are you sure?', $params = '')
    {
        $component->dialog()->confirm([
            'title'       => $title,
            'description' => $description,
            'acceptLabel' => 'Yes, proceed',
            'method'      => $confirmMethod,
            'params'      => $params,
        ]);
    }
}
