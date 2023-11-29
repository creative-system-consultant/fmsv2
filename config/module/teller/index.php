<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Teller -  Tab Teller
    |--------------------------------------------------------------------------
    */
    [
        'permission' => 'payment in tab',
        'label' => 'Payment In',
        'icon' => 'login',
        'index' => '0',
        'wireClickFunction' => 'clearPaymentIn',
    ],
    [
        'permission' => 'payment out tab',
        'label' => 'Payment Out',
        'icon' => 'logout',
        'index' => '1',
        'wireClickFunction' => 'clearPaymentOut',
    ],
];
