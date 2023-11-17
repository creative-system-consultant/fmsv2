<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Report Listing Page - Operation Report
    |--------------------------------------------------------------------------
    */


/*
|--------------------------------------------------------------------------
| Contribution Group
|--------------------------------------------------------------------------
*/
    [
        'permission' => 'contribution payment',
        'title' => 'Contribution Payment',
        'group' => 'Contribution',
        'index' =>  '6',
        'route' => 'report.operation.contribution.payment',
    ],
    [
        'permission' => 'contribution wihdrawal',
        'title' => 'Contribution Withdrawal',
        'group' => 'Contribution',
        'index' =>  '6',
        'route' => 'report.operation.contribution.withdrawal',
    ],
/*
|--------------------------------------------------------------------------
| Daily Transaction Group
|--------------------------------------------------------------------------
*/
    [
        'permission' => 'daily transaction listing',
        'title' => 'Daily Transaction Listing',
        'group' => 'Daily Transaction',
        'index' =>  '7',
        'route' => 'report.operation.dailytransaction.listing',
    ],
    [
        'permission' => 'daily transaction by product',
        'title' => 'Daily Transaction By Product',
        'group' => 'Daily Transaction',
        'index' =>  '7',
        'route' => 'report.operation.dailytransaction.product',
    ],
/*
|--------------------------------------------------------------------------
|  Financing Group
|--------------------------------------------------------------------------
*/
    [
        'permission' => 'financing summary',
        'title' => 'Financing Summary',
        'group' => 'Financing',
        'index' =>  '8',
        'route' => 'report.operation.financing.summary',
    ],
    [
        'permission' => 'financing disbursement',
        'title' => 'Financing Disbursement',
        'group' => 'Financing',
        'index' =>  '8',
        'route' => 'report.operation.financing.disbursement',
    ],
    [
        'permission' => 'financing cash detail',
        'title' => 'Financing Cash Detail',
        'group' => 'Financing',
        'index' =>  '8',
        'route' => 'report.operation.financing.cashdetail',
    ],
    [
        'permission' => 'financing approval',
        'title' => 'Financing Approval',
        'group' => 'Financing',
        'index' =>  '8',
        'route' => 'report.operation.financing.approval',
    ],
/*
|--------------------------------------------------------------------------
|  List Group
|--------------------------------------------------------------------------
*/
    [
        'permission' => 'list of autopay',
        'title' => 'List Of Autopay',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.autopay',
    ],
    [
        'permission' => 'list of member',
        'title' => 'List Of Member',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.member',
    ],
    [
        'permission' => 'list of closed member',
        'title' => 'List Of Closed Member',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.closed-member',
    ],
    [
        'permission' => 'list of bank',
        'title' => 'List Of Bank',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.bank',
    ],
    [
        'permission' => 'list of member not pay contribution',
        'title' => 'List Of Member Not Pay Contribution',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.member-not-pay-contribution',
    ],
    [
        'permission' => 'list of dormant member',
        'title' => 'List Of Dormant Member',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.dormant-member',
    ],
    [
        'permission' => 'list of entrance fee',
        'title' => 'List Of Entrance Fee',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.entrance-fee',
    ],
    [
        'permission' => 'list of financing',
        'title' => 'List Of Financing',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.financing',
    ],
    [
        'permission' => 'list of full settlement',
        'title' => 'List Of Full Settlement',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.full-settlement',
    ],
    [
        'permission' => 'list of introducer',
        'title' => 'List Of Introducer',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.introducer',
    ],
    [
        'permission' => 'list of deduction',
        'title' => 'List Of Deduction',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.deduction',
    ],
    [
        'permission' => 'list of retirement',
        'title' => 'List Of Retirement',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.retirement',
    ],
    [
        'permission' => 'list of non-cash products',
        'title' => 'List Of Non-Cash Products',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.non-cash-product',
    ],
    [
        'permission' => 'list of detail cash disbursement',
        'title' => 'List Of Detail Cash Disbursement',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.detail-for-cash-disbursement',
    ],
    [
        'permission' => 'list of takaful payment',
        'title' => 'List Of Takaful Payment',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.takaful-payment',
    ],
    [
        'permission' => 'list of dividend payment',
        'title' => 'List Of Dividend Payment',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.dividend-payment',
    ],
    [
        'permission' => 'list of fin transaction base on disbursement',
        'title' => 'List Of Fin Transaction Base On Disbursement',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.fin-trx-base-disbursement',
    ],
    [
        'permission' => 'list of bske & goldbar transactions',
        'title' => 'List Of BSKE and GOLDBAR Transactions',
        'group' => 'List',
        'index' =>  '9',
        'route' => 'report.operation.list.Bske-Goldbar-Trax',
    ],
/*
|--------------------------------------------------------------------------
| Member Group
|--------------------------------------------------------------------------
*/
    [
        'permission' => 'member by income',
        'title' => 'Member By Income',
        'group' => 'Member',
        'index' =>  '10',
        'route' => 'report.operation.member.byincome',
    ],
    [
        'permission' => 'member by state',
        'title' => 'Member By State',
        'group' => 'Member',
        'index' =>  '10',
        'route' => 'report.operation.member.by-state',
    ],

/*
|--------------------------------------------------------------------------
| Monthly Group
|--------------------------------------------------------------------------
*/
    [
        'permission' => 'monthly npf account',
        'title' => 'Monthly Npf Account',
        'group' => 'Monthly',
        'index' =>  '11',
        'route' => 'report.operation.monthly.mthlynpfacc',
    ],
    [
        'permission' => 'monthly arrears account',
        'title' => 'Monthly Arrears Account',
        'group' => 'Monthly',
        'index' =>  '11',
        'route' => 'report.operation.monthly.arrears-account',
    ],
    [
        'permission' => 'monthly financing position',
        'title' => 'Monthly Financing Position',
        'group' => 'Monthly',
        'index' =>  '11',
        'route' => 'report.operation.monthly.mthly-fin-position',
    ],
    [
        'permission' => 'list of share details',
        'title' => 'List Of Share Details',
        'group' => 'Monthly',
        'index' =>  '11',
        'route' => 'report.operation.monthly.list-share-detail',
    ],
    [
        'permission' => 'share summary yearly',
        'title' => 'Share Summary Yearly',
        'group' => 'Monthly',
        'index' =>  '11',
        'route' => 'report.operation.monthly.share-summary-yearly',
    ],
    [
        'permission' => 'contribution details monthly',
        'title' => 'Contribution Details Monthly',
        'group' => 'Monthly',
        'index' =>  '11',
        'route' => 'report.operation.monthly.contribution-details-monthly',
    ],
    [
        'permission' => 'contribution summary yearly',
        'title' => 'Contribution Summary Yearly',
        'group' => 'Monthly',
        'index' =>  '11',
        'route' => 'report.operation.monthly.contribution-summary-yearly',
    ],
    [
        'permission' => 'financing summary yearly',
        'title' => 'Financing Summary Yearly',
        'group' => 'Monthly',
        'index' =>  '11',
        'route' => 'report.operation.monthly.financing-summary-yearly',
    ],
    [
        'permission' => 'details yearly share',
        'title' => 'Details Yearly Share',
        'group' => 'Monthly',
        'index' =>  '11',
        'route' => 'report.operation.monthly.details-yearly-share',
    ],
    [
        'permission' => 'details yearly contributions',
        'title' => 'Details Yearly Contributions',
        'group' => 'Monthly',
        'index' =>  '11',
        'route' => 'report.operation.monthly.details-yrly-cont',
    ],
    [
        'permission' => 'details financing monthly',
        'title' => 'Details Financing Monthly',
        'group' => 'Monthly',
        'index' =>  '11',
        'route' => 'report.operation.monthly.details-fin-mthly',
    ],
    [
        'permission' => 'details financing yearly',
        'title' => 'Details Financing Yearly',
        'group' => 'Monthly',
        'index' =>  '11',
        'route' => 'report.operation.monthly.details-fin-yrly',
    ],
    [
        'permission' => 'month arrears report(rescheduled) - monthly',
        'title' => 'Month Arrears Report(Rescheduled) - Monthly',
        'group' => 'Monthly',
        'index' =>  '11',
        'route' => 'report.operation.monthly.report-resc',
    ],
/*
|--------------------------------------------------------------------------
| Share Group
|--------------------------------------------------------------------------
*/
    [
        'permission' => 'share purchase',
        'title' => 'Share Purchase',
        'group' => 'Share',
        'index' =>  '12',
        'route' => 'report.operation.share.share-purchase',
    ],
    [
        'permission' => 'share redemption',
        'title' => 'Share Redemption',
        'group' => 'Share',
        'index' =>  '12',
        'route' => 'report.operation.share.share-redemption',
    ],
    [
        'permission' => 'share withdrawal',
        'title' => 'Share Withdrawal',
        'group' => 'Share',
        'index' =>  '12',
        'route' => 'report.operation.share.share-withdrawal',
    ],
/*
|--------------------------------------------------------------------------
| Summary Group
|--------------------------------------------------------------------------
*/
    [
        'permission' => 'summary total share',
        'title' => 'Summary Total Share',
        'group' => 'Summary',
        'index' =>  '13',
        'route' => 'report.operation.summary.sum-total-share',
    ],
    [
        'permission' => 'summary total contribution',
        'title' => 'Summary Total Contribution',
        'group' => 'Summary',
        'index' =>  '13',
        'route' => 'report.operation.summary.sum-total-cont',
    ],
/*
|--------------------------------------------------------------------------
| GL Group
|--------------------------------------------------------------------------
*/
    [
        'permission' => 'detail gl',
        'title' => 'Detail GL',
        'group' => 'GL',
        'index' =>  '14',
        'route' => 'report.operation.g-l.detail-gl',
    ],
    [
        'permission' => 'detail gl by account',
        'title' => 'Detail GL by Account',
        'group' => 'GL',
        'index' =>  '14',
        'route' => 'report.operation.g-l.detail-gl-by-account',
    ],
    [
        'permission' => 'detail gl by bank recon',
        'title' => 'Detail GL By Bank Recon',
        'group' => 'GL',
        'index' =>  '14',
        'route' => 'report.operation.g-l.gl-bank-recon',
    ],

];
