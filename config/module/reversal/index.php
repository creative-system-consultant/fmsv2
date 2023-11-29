<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Reversal -  Tab Reversal
    |--------------------------------------------------------------------------
    */
    [
        'permission' => 'financing tab',
        'label' => 'Financing',
        'icon' => 'currency-dollar',
        'index' => '0',
        'wireClickFunction' => 'clearFinancing',
    ],
    [
        'permission' => 'general tab',
        'label' => 'General',
        'icon' => 'collection',
        'index' => '1',
        'wireClickFunction' => 'clearGeneral',
    ],
];
