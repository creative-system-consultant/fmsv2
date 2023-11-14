<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Sidebar Management
    |--------------------------------------------------------------------------
    */

    [
        'permission' => 'access user management',
        'title' => 'User Management',
        'activeUrl' => 'user-management',
        'route' => 'userManagement',
        'icon' => 'user-group',
    ],
    [
        'permission' => 'access roles',
        'title' => 'Roles',
        'activeUrl' => 'roles',
        'route' => 'roles.index',
        'icon' => 'shield-check',
    ],
    [
        'permission' => 'access member info',
        'title' => 'Member Info',
        'activeUrl' => 'cif/*',
        'route' => 'cif.main',
        'icon' => 'user-group',
    ],
    [
        'permission' => 'access financing info',
        'title' => 'Financing Info',
        'activeUrl' => 'finance/*',
        'route' => 'finance.finance-financing-info',
        'icon' => 'database',
    ],
    [
        'permission' => 'access other info',
        'title' => 'Other Info',
        'activeUrl' => 'other/*',
        'route' => 'other.info-list',
        'icon' => 'collection',
    ],
    [
        'permission' => 'access teller',
        'title' => 'Teller',
        'activeUrl' => 'teller/*',
        'route' => 'teller.teller-list',
        'icon' => 'currency-dollar',
    ],
    [
        'permission' => 'access reversal',
        'title' => 'Reversal',
        'activeUrl' => 'reversal/*',
        'route' => 'reversal.reversal-list',
        'icon' => 'refresh',
    ],
    [
        'permission' => 'access calculator',
        'title' => 'Calculator',
        'activeUrl' => 'calculator/*',
        'route' => 'calculator.calculator-index',
        'icon' => 'calculator',
    ],
    [
        'permission' => 'access dividen',
        'title' => 'Dividen',
        'activeUrl' => 'dividen/*',
        'route' => 'dividen.dividen-index',
        'icon' => 'presentation-chart-line',
    ],
    [
        'permission' => 'access report',
        'title' => 'Report',
        'activeUrl' => 'report/*',
        'route' => 'report.report-list',
        'icon' => 'clipboard-list',
    ],
    [
        'permission' => 'access setting',
        'title' => 'Setting',
        'activeUrl' => 'Admin/*',
        'route' => 'setting.setting-list',
        'icon' => 'cog',
    ],
];
