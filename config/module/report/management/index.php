<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Report Listing Page - Manangement Report
    |--------------------------------------------------------------------------
    */

/*
|--------------------------------------------------------------------------
| Monthly Arreas Group
|--------------------------------------------------------------------------
*/
    [
        'permission' => 'monthly arrears account by age',
        'title' => 'Monthly Arrears Account By Age',
        'group' => 'Monthly Arreas',
        'index' =>  '1',
        'route' => 'report.management.monthly-arrears.mth-by-age',
        
    ],
    [
        'permission' => 'monthly arrears account by employer',
        'title' => 'Monthly Arrears Account By Employer',
        'group' => 'Monthly Arreas',
        'index' =>  '1',
        'route' => 'report.management.monthly-arrears.mth-by-employer',
    ],
    [
        'permission' => 'monthly arrears account by state',
        'title' => 'Monthly Arrears Account By State',
        'group' => 'Monthly Arreas',
        'index' =>  '1',
        'route' => 'report.management.monthly-arrears.mth-by-state',
    ],
    [
        'permission' => 'monthly arrears account by product',
        'title' => 'Monthly Arrears Account By Product',
        'group' => 'Monthly Arreas',
        'index' =>  '1',
        'route' => 'report.management.monthly-arrears.mth-by-product',
    ],
    [
        'permission' => 'monthly arrears ageing',
        'title' => 'Monthly Arrears Ageing',
        'group' => 'Monthly Arreas',
        'index' =>  '1',
        'route' => 'report.management.monthly-arrears.mth-ageing',
    ],

/*
|--------------------------------------------------------------------------
| Monthly Contribution Group
|--------------------------------------------------------------------------
*/

    [
        'permission' => 'monthly contribution summary',
        'title' => 'Monthly Contribution Summary',
        'group' => 'Monthly Contribution',
        'index' =>  '2',
        'route' => 'report.management.monthly-contribution.contribution-summary',
    ],

/*
|--------------------------------------------------------------------------
| Monthly Financing Position Group
|--------------------------------------------------------------------------
*/
    [
        'permission' => 'monthly financing position summary',
        'title' => 'Monthly Financing Position Summary',
        'group' => 'Monthly Financing Position',
        'index' =>  '3',
        'route' => 'report.management.monthly-financing-position.financing-position',
    ],


/*
|--------------------------------------------------------------------------
| Monthly Npf Group
|--------------------------------------------------------------------------
*/
    [
        'permission' => 'monthly npf summary',
        'title' => 'Monthly Npf Summary',
        'group' => 'Monthly Npf',
        'index' =>  '4',
        'route' => 'report.management.monthly-npf.mthly-npf-sum',
    ],

/*
|--------------------------------------------------------------------------
| Monthly Share
|--------------------------------------------------------------------------
*/
    [
        'permission' => 'monthly share summary',
        'title' => 'Monthly Share Summary',
        'group' => 'Monthly Share',
        'index' =>  '5',
        'route' => 'report.management.monthly-share.mth-share-summary',
    ],
    [
        'permission' => 'monthly share summary',
        'title' => 'Monthly Share Summary',
        'group' => 'Monthly Share',
        'index' =>  '5',
        'route' => 'report.management.monthly-share.mth-share-summary',
    ],
];
