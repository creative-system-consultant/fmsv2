<?php

use App\Models\User;
use App\Models\Audit;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;

//functions
function yearIC(
  $str = null
) {
  if (is_null($str) or $str == '') {
    $str = '00';
  }

  $f = intval(substr(date('Y'), 0, 2));

  if (intval($str) <= intval(date('y'))) {
    return strval($f) . $str;
  } else {
    return strval($f - 1) . $str;
  }
}

function change_password(
  $email           = null,
  $password        = null
) {
  $user = User::where('email', $email)->first();
  $user->password = Hash::make($password);
  $user->update();
  return 'yay';
}

//sp
function up_dashboard_summary_customer_statements()
{
  $result = DB::select('EXEC up_dashboard_summary_customer_statements ?', [auth()->user()->group->institute_id]);
  $result = array_combine(array_column($result, 'transaction'), array_column($result, 'total'));
  return $result;
}

function up_dashboard_summary_customer_statuses()
{
  $result = DB::select('EXEC up_dashboard_summary_customer_statuses ?', [auth()->user()->group->institute_id]);
  // $result = array_combine(array_column($result,'transaction'),array_column($result,'total'));
  return $result;
}

function up_dashboard_summary_customer_types()
{
  $result = DB::select('EXEC up_dashboard_summary_customer_types ?', [auth()->user()->group->institute_id]);
  // $result = array_combine(array_column($result,'transaction'),array_column($result,'total'));
  return $result;
}

function up_graph_customer_projection(
  $rate       = null,
  $year           = null,
  $type           = null,
  $institute_id   = null
) {
  if (is_null($rate) or $rate == '') {
    return 'Rate is empty';
  }
  if (is_null($year) or $year == '') {
    return 'Year is empty';
  }
  if (is_null($type) or $type == '') {
    return 'Type. is empty';
  }
  if (is_null($institute_id) or $institute_id == '') {
    return 'Institute is empty';
  }
  $result        = DB::select("
                                EXEC    up_graph_customer_projection
                                        $rate,
                                        $year,
                                        '$type',
                                        $institute_id
                            ");

  return $result;
}

function up_graph_customers_summary(
  $table           = null,
  $institute_id   = null
) {
  if (is_null($table) or $table == '') {
    return 'Type. is empty';
  }
  if (is_null($institute_id) or $institute_id == '') {
    return 'Institute is empty';
  }
  $result        = DB::select("
                                EXEC up_graph_customers_summary
                                    '$table',
                                    $institute_id
                            ");

  return $result;
}

//function lama anis inert trx contribution and share
// function up_teller_customer_statement_insert(
//     $customer_id            = null,
//     $transaction_code_id    = null,
//     $transaction_date       = null,
//     $type                   = null,
//     $bank_id                = null,
//     $cheque_no              = null,
//     $cheque_date            = null,
//     $doc_no                 = null,
//     $amount                 = null,
//     $user_id                = null
// ){
//     if(is_null($customer_id) or $customer_id == ''){
//         return 'Customer is empty. customer_id = ';
//     }

//     if(is_null($transaction_code_id) or $transaction_code_id == ''){
//         return 'Transaction Code is empty';
//     }

//     if(is_null($transaction_date) or $transaction_date == ''){
//         return 'Transaction Date is empty';
//     }

//     if(is_null($type) or $type == ''){
//         return 'Type of Payment is empty';
//     }elseif($type == 'cheque'){
//         if(is_null($bank_id) or $bank_id == ''){
//             return 'Bank is empty';
//         }

//         if(is_null($cheque_no) or $cheque_no == ''){
//             return 'Cheque No. is empty';
//         }
//         if(is_null($cheque_date) or $cheque_date == ''){
//             return 'Cheque Date is empty';
//         }
//     }

//     if(is_null($doc_no) or $doc_no == ''){
//         return 'Document No. is empty';
//     }

//     if(is_null($amount) or $amount == ''){
//         return 'Amount is empty';
//     }

//     if(is_null($user_id) or $user_id == ''){
//         return 'User is empty';
//     }

//     $result		= DB::select("
//                                 EXEC	up_teller_customer_statement_insert
//                                         '$customer_id',
//                                         '$transaction_code_id',
//                                         '$transaction_date',
//                                         '$bank_id',
//                                         '$cheque_no',
//                                         '$cheque_date',
//                                         '$doc_no',
//                                         '$amount',
//                                         '$user_id'
//                             ");

//     //Audit
//     $data = [
//             "user_type"      => "App\Models\User",
//             "user_id"        => auth()->user()->id,
//             "event"          => "storeprocedure",
//             'auditable_type' => "App\Models\CustomerStatement",
//             'auditable_id'   => $result[0]->id,
//             "sp_name"        => "up_teller_customer_statement_insert",
//             "sp_values"      => '{"customer_id":'.$customer_id.',"transaction_code_id":'.$transaction_code_id.',"transaction_date":'.$transaction_date.',"type":'.$type.',"bank_id":'.$bank_id.',"cheque_no":'.$cheque_no.',"cheque_date":'.$cheque_date.',"doc_no":'.$doc_no.',"amount":'.$amount.',"user_id":'.$user_id.'}',
//             'url'            => request()->fullUrl(),
//             'ip_address'     => request()->getClientIp(),
//             'user_agent'     => request()->userAgent(),
//             'created_at'     => Carbon::now(),
//             'updated_at'     => Carbon::now(),
//         ];
//     Audit::create($data);

//     return $result[0]->id;
// }

// function insert insert contribution by hafidz 16/09/2021

function up_trx_contribution_in(
  $mbrno              = null,
  $caruman_approved   = null,
  $txn_date           = null,
  $doc_no             = null,
  $txn_code           = null,
  $remarks            = null,
  $bank_id            = null,
  $user_id            = null,
  $cheque_date        = null,
  $oid                = null,
  $bank_koputra       = null

) {
  //dd($mbrno,$caruman_approved,$txn_date,$doc_no,$txn_code,$remarks,$bank_id,$user_id,$cheque_date,$oid,$bank_koputra);
  if (is_null($mbrno) or $mbrno == '') {
    return 'membership is empty. mbrno = ';
  }

  if (is_null($caruman_approved) or $caruman_approved == '') {
    return 'amount is empty.';
  }

  if (is_null($txn_date) or $txn_date == '') {
    return 'transaction date is empty.';
  }

  // if(is_null($doc_no) or $doc_no == ''){
  //     return 'document is empty.';
  // }

  if (is_null($txn_code) or $txn_code == '') {
    return 'transaction code is empty.';
  }

  // if(is_null($bank_id) or $bank_id == ''){
  //     return 'bank is empty.';
  // }

  if (is_null($user_id) or $user_id == '') {
    return 'user is empty.';
  }

  // if(is_null($oid) or $oid == ''){
  //     return '$oid is empty.';
  // }

  $result        = DB::update(
    'SET NOCOUNT ON;
                                EXEC up_trx_contribution_in ?,?,?,?,?,?,?,?,?,?,?',
    [
      $mbrno, $caruman_approved, $txn_date, $doc_no, $txn_code, $remarks, $bank_id, $user_id, $cheque_date, $oid, $bank_koputra
    ]
  );
  //dd($id_update);
  //Audit up_trx_contribution_in
  // $data = [
  //     "user_type"      => "App\Models\User",
  //     "user_id"        => auth()->user()->id,
  //     "event"          => "storeprocedure",
  //     'auditable_type' => "App\Models\CustomerStatement",
  //     'auditable_id'   => $result[0]->id,
  //     "sp_name"        => "up_trx_contribution_in",
  //     "sp_values"      => '{
  //                             "mbrno":'.$mbrno.',
  //                             "txn_amt":'.$txn_amt.',
  //                             "txn_date":'.$txn_date.',
  //                             "doc_no":'.$type.',
  //                             "txn_code":'.$bank_id.',

  //                             "remarks":'.$remarks.',
  //                             "bank_id":'.$bank_id.',
  //                             "user_id":'.$user_id.',
  //                             "cheque_date":'.$cheque_date.'
  //                         }',
  //     'url'            => request()->fullUrl(),
  //     'ip_address'     => request()->getClientIp(),
  //     'user_agent'     => request()->userAgent(),
  //     'created_at'     => Carbon::now(),
  //     'updated_at'     => Carbon::now(),
  // ];
  // Audit::create($data);

  // return $result[0]->id;
}

//function insert pre-disbursement
function up_trx_pre_disbursement(

  $uuid                                = null,
  $agreement_exe_date                    = null,
  $agreement_stamp_date                = null,
  $offer_letter_exe_date                = null,
  $offer_letter_stamp_date            = null,
  $pre_disbursement_flag                = null,
  $pre_disbursement_offer_flag        = null
) {
  if (is_null($uuid) or $uuid == '') {
    return 'uuid is empty';
  }

  if (is_null($agreement_exe_date) or $agreement_exe_date == '') {
    return 'transacrion amaount is empty';
  }

  // if(is_null($agreement_stamp_date) or $agreement_stamp_date == ''){
  //     return 'agreement stemp is empty';
  // }

  if (is_null($offer_letter_exe_date) or $offer_letter_exe_date == '') {
    return 'offer letter date no is empty';
  }

  // if(is_null($offer_letter_stamp_date) or $offer_letter_stamp_date == ''){
  //     return 'offer stamp date no is empty';
  // }

  if (is_null($pre_disbursement_flag) or $pre_disbursement_flag == '') {
    return 'pre disbursement flag id no is empty';
  }

  $result        = DB::update(
    'SET NOCOUNT ON;
                                EXEC FMS.up_trx_pre_disbursement ?,?,?,?,?,?,?',
    [
      $uuid, $agreement_exe_date, $agreement_stamp_date, $offer_letter_exe_date, $offer_letter_stamp_date, $pre_disbursement_flag, $pre_disbursement_offer_flag
    ]
  );
}

//function insert disbursement
function up_trx_3610_disbursement(

  $account_no = null,
  $txn_amt    = null,
  $txn_code   = null,
  $fin_pv_no    = null,
  $txn_date   = null,
  $created_by = null,
  $bank_kopura = null
) {
  //dd($account_no,$txn_amt,$txn_code,$fin_pv_no,$txn_date,$created_by,$bank_kopura);
  if (is_null($account_no) or $account_no == '') {
    return 'Account is empty';
  }

  if (is_null($txn_amt) or $txn_amt == '') {
    return 'Transaction amaount is empty';
  }

  if (is_null($txn_code) or $txn_code == '') {
    return 'Transaction code is empty';
  }

  // if(is_null($doc_no) or $doc_no == ''){
  //     return 'document no is empty';
  // }

  if (is_null($txn_date) or $txn_date == '') {
    return 'transaction date no is empty';
  }

  // if(is_null($user_id) or $user_id == ''){
  //     return 'user id no is empty';
  // }

  if (is_null($bank_kopura) or $bank_kopura == '') {
    return 'bank koputra no is empty';
  }

  $result        = DB::update(
    'SET NOCOUNT ON;
                                EXEC FMS.up_trx_3610_disbursement ?,?,?,?,?,?,?',
    [
      $account_no, $txn_amt, $txn_code, $fin_pv_no, $txn_date, $created_by, $bank_kopura
    ]
  );
  //dd($result);
  //die();
}


//monthly financing payment 3800
function up_trx_3800_financing_payment(
  $account_no,
  $txn_amt,
  $txn_code,
  $doc_no,
  $transaction_date,
  $remarks,
  $bank_koputra,
  $user_id
) {
  //dd($account_no,$txn_amt,$txn_code,$doc_no,$transaction_date,$remarks,$bank_koputra,$user_id);

  $result = DB::update(
    'SET NOCOUNT ON;
                EXEC FMS.up_trx_3800_financing_payment ?,?,?,?,?,?,?,?',
    [
      $account_no, $txn_amt, $txn_code, $doc_no, $transaction_date, $remarks, $bank_koputra, $user_id

    ]
  );
  //dd($result);
}


//Early settlement payment 3920
function up_trx_3920_early_settlement(
  $account_no,
  $txn_amt,
  $txn_code,
  $doc_no,
  $txn_date,
  $user_id,
  $remarks,
  $bank_koputra


) {
  //dd($account_no,$txn_amt,$txn_code,$doc_no,$txn_date,$user_id,$remarks,$bank_koputra);
  if (is_null($account_no) or $account_no == '') {
    return 'Account is empty';
  }

  if (is_null($txn_amt) or $txn_amt == '') {
    return 'txn_amt is empty';
  }

  if (is_null($txn_code) or $txn_code == '') {
    return 'txn_code is empty';
  }

  // if(is_null($doc_no) or $doc_no == ''){
  //     return 'doc_no is empty';
  // }

  if (is_null($txn_date) or $txn_date == '') {
    return 'txn_date is empty';
  }

  if (is_null($bank_koputra) or $bank_koputra == '') {
    return 'bank koputra is empty';
  }

  $result = DB::update(
    'SET NOCOUNT ON;
                EXEC FMS.up_trx_3920_early_settlement ?,?,?,?,?,?,?,?',
    [
      $account_no, $txn_amt, $txn_code, $doc_no, $txn_date, $user_id, $remarks, $bank_koputra

    ]
  );
  //dd($result);
}

//transfer share
function up_trx_share_transfer(
  $seller_no,
  $member_no,
  $share_approved,
  $approval_at,
  $remarks,
  $id
) {
  //dd($seller_no,$member_no,$share_approved,$approval_at,$remarks,$id);
  if (is_null($seller_no) or $seller_no == '') {
    return 'seller_no is empty';
  }

  if (is_null($share_approved) or $share_approved == '') {
    return 'share_approved is empty';
  }

  if (is_null($member_no) or $member_no == '') {
    return 'member_no is empty';
  }

  if (is_null($id) or $id == '') {
    return 'id is empty';
  }

  if (is_null($approval_at) or $approval_at == '') {
    return 'approval_at is empty';
  }

  $result = DB::update(
    'SET NOCOUNT ON;
                EXEC FMS.up_trx_share_transfer ?,?,?,?,?,?',
    [
      $seller_no, $member_no, $share_approved, $approval_at, $remarks, $id

    ]
  );
  //dd($result);

  return 'ok';
}

//3rd third party
function up_trx_thirdparty(
  $mbrno,
  $institution_code,
  $payment_mode,
  $updated_amt,
  $txn_date,
  $doc_no,
  $bank_id,
  $cheque_no,
  $cheque_date,
  $remarks,
  $user_id,
  $mode,
  $bank_koputra,
  $ids

) {
  //dd($mbrno,$institution_code,$payment_mode,$updated_amt,$txn_date,$doc_no,$bank_id,$cheque_no,$cheque_date,$remarks,$user_id,$mode,$bank_koputra,$ids);
  if (is_null($mbrno) or $mbrno == '') {
    return 'mbrno is empty';
  }

  if (is_null($institution_code) or $institution_code == '') {
    return 'institution_code is empty';
  }

  if (is_null($payment_mode) or $payment_mode == '') {
    return 'transaction_code is empty';
  }

  if (is_null($updated_amt) or $updated_amt == '') {
    return 'txn_amt is empty';
  }

  if (is_null($txn_date) or $txn_date == '') {
    return 'txn_date is empty';
  }

  if (is_null($mode) or $mode == '') {
    return 'mode is empty';
  }

  // if(is_null($ids) or $ids == ''){
  //     return 'id is empty';
  // }

  if (is_null($bank_id) or $bank_id == '') {
    $bank_id = null;
  }

  if (is_null($cheque_no) or $cheque_no == '') {
    $cheque_no = null;
  }

  if (is_null($cheque_date) or $cheque_date == '') {
    $cheque_date = null;
  }


  DB::update('EXECUTE fms.up_trx_thirdparty ?,?,?,?,?,?,?,?,?,?,?,?,?,?', [
    $mbrno,
    $institution_code,
    $payment_mode,
    $updated_amt,
    $txn_date,
    $doc_no,
    $bank_id,
    $cheque_no,
    $cheque_date,
    $remarks,
    $user_id,
    $mode,
    $bank_koputra,
    $ids
  ]);

  return 'ok';
}

//function other payment tabung kebajikan
function up_trx_others_paymentTabung(
  $fms_ref_no,
  $introducer_mbrno,
  $txn_amount,
  $txn_date,
  $doc_no,
  $txn_code,
  $remark,
  $bank_desc,
  $bank_acct_no,
  $user_id,
  $uuid,
  $bank_koputra
) {
  //dd($fms_ref_no,$introducer_mbrno,$txn_amount,$txn_date,$doc_no,$txn_code,$remark,$bank_desc,$bank_acct_no,$user_id,$uuid,$bank_koputra);
  // if(is_null($fms_ref_no) or $fms_ref_no == ''){
  //     return 'Membership no is empty';
  // }

  // if(is_null($txn_amount) or $txn_amount == ''){
  //     return 'Transaction amount is empty';
  // }

  // if(is_null($txn_date) or $txn_date == ''){
  //     return 'txn_date is empty';
  // }

  // if(is_null($bank_desc) or $bank_desc == ''){
  //     return 'bank desc is empty';
  // }

  // if(is_null($txn_code) or $txn_code == ''){
  //     return 'txn_code is empty';
  // }

  // if(is_null($bank_acct_no) or $bank_acct_no == ''){
  //     return 'bank_acct_no is empty';
  // }

  // if(is_null($user_id) or $user_id == ''){
  //     return 'user_id is empty';
  // }
  DB::update('EXECUTE FMS.up_trx_others_payment ?,?,?,?,?,?,?,?,?,?,?,?', [
    $fms_ref_no,
    $introducer_mbrno,
    $txn_amount,
    $txn_date,
    $doc_no,
    $txn_code,
    $remark,
    $bank_desc,
    $bank_acct_no,
    $user_id,
    $uuid,
    $bank_koputra
  ]);
}
//end other payment tabung kebajikan


//function other payment tabung khairat
function up_trx_others_khairat(
  $fms_ref_no,
  $khairat_waris,
  $khairat_wakaf,
  $txn_amt,
  $txn_date,
  $doc_no,
  $remark,
  $bank_desc,
  $user_id,
  $bank_acct_no,
  $uuid,
  $bank_koputra
) {
  //dd($fms_ref_no,$khairat_waris,$khairat_wakaf,$txn_amt,$txn_date,$doc_no,$remark,$bank_desc,$user_id,$bank_acct_no,$uuid,$bank_koputra);
  // if(is_null($fms_ref_no) or $fms_ref_no == ''){
  //     return 'Membership no is empty';
  // }

  // if(is_null($khairat_waris) or $khairat_waris == ''){
  //     return 'khairat_waris amount is empty';
  // }

  // if(is_null($khairat_wakaf) or $khairat_wakaf == ''){
  //     return 'khairat_wakaf is empty';
  // }

  // if(is_null($bank_desc) or $bank_desc == ''){
  //     return 'bank_desc is empty';
  // }

  // if(is_null($bank_acct_no) or $bank_acct_no == ''){
  //     return 'bank_acct_no is empty';
  // }

  // if(is_null($user_id) or $user_id == ''){
  //     return 'user_id is empty';
  // }
  DB::update('EXECUTE FMS.up_trx_others_khairat ?,?,?,?,?,?,?,?,?,?,?,?', [
    $fms_ref_no,
    $khairat_waris,
    $khairat_wakaf,
    $txn_amt,
    $txn_date,
    $doc_no,
    $remark,
    $bank_desc,
    $user_id,
    $bank_acct_no,
    $uuid,
    $bank_koputra
  ]);
}
//end other payment tabung khairat

//retirement proses
function up_trx_retirement_process(
  $ref_no,
  $total_all,
  $transaction_date,
  $doc_no,
  $remarks,
  $user_id,
  $bank_koputra,
  $bank_members

) {
  //dd($ref_no,$total_all,$transaction_date,$doc_no,$remarks,$user_id,$bank_koputra);
  if (is_null($ref_no) or $ref_no == '') {
    return 'mbrno is empty';
  }

  if (is_null($total_all) or $total_all == '') {
    return 'total_all is empty';
  }

  if (is_null($transaction_date) or $transaction_date == '') {
    return 'transaction_date is empty';
  }


  DB::update('EXECUTE FMS.up_trx_retirement_process ?,?,?,?,?,?,?,?', [
    $ref_no,
    $total_all,
    $transaction_date,
    $doc_no,
    $remarks,
    $user_id,
    $bank_koputra,
    $bank_members

  ]);
  //dd($introducer_mbrno);
}
//end retirement process

//general payment start
function up_trx_payment_all(
  $ref_no,
  $txn_amt,
  $transaction_date,
  $doc_no,
  $transaction_code_id,
  $remarks,
  $bank_id,
  $user_id,
  $cheque_date
  // $cheque_no

) {
  //dd($ref_no,$txn_amt,$transaction_date,$doc_no,$transaction_code_id,$remarks,$bank_id,$user_id,$cheque_date);

  if (is_null($ref_no) or $ref_no == '') {
    return 'ref_no is empty';
  }

  if (is_null($txn_amt) or $txn_amt == '') {
    return 'txn_amt is empty';
  }

  if (is_null($transaction_date) or $transaction_date == '') {
    return 'transaction_date is empty';
  }

  // if(is_null($doc_no) or $doc_no == ''){
  //     return 'doc_no is empty';
  // }

  if (is_null($transaction_code_id) or $transaction_code_id == '') {
    return 'transaction_code_id is empty';
  }

  // if(is_null($remarks) or $remarks == ''){
  //     return 'txn_code is empty';
  // }

  // if(is_null($bank_id) or $bank_id == ''){
  //     return 'bank_id is empty';
  // }

  if (is_null($user_id) or $user_id == '') {
    return 'user_id is empty';
  }

  // if(is_null($cheque_date) or $cheque_date == ''){
  //     return 'cheque_date is empty';
  // }

  // if(is_null($cheque_no) or $cheque_no == ''){
  //     return 'cheque_no is empty';
  // }

  DB::update('EXECUTE FMS.up_trx_payment_all ?,?,?,?,?,?,?,?,?', [
    $ref_no,
    $txn_amt,
    $transaction_date,
    $doc_no,
    $transaction_code_id,
    $remarks,
    $bank_id,
    $user_id,
    $cheque_date
    // $cheque_no
  ]);

  // DB::update('EXECUTE FMS.up_trx_bulk_payment ?',[
  //     $user_id,
  // ]);

}
//general payment end

function up_cif_create_new_finance_account(
  $account_no,
  $product_id,
  $concept_id,
  $approved_date,
  $approved_limit,
  $profit_rate,
  $duration,
  $selling_price,
  $instal_amt,
  $customer_id,
  $institute_id,
  $created_by
) {
  // dd(
  //     $account_no."\r\n".
  //     $product_id."\r\n".
  //     $concept_id."\r\n".
  //     $approved_date."\r\n".
  //     $approved_limit."\r\n".
  //     $profit_rate."\r\n".
  //     $duration."\r\n".
  //     $selling_price."\r\n".
  //     $instal_amt
  //     .""
  // );
  $result        = DB::select("
                                EXECUTE up_cif_create_new_finance_account
                                    '$account_no'
                                    ,$product_id
                                    ,$concept_id
                                    ,'$approved_date'
                                    ,$approved_limit
                                    ,$profit_rate
                                    ,$duration
                                    ,$selling_price
                                    ,$instal_amt
                                    ,$customer_id
                                    ,$institute_id
                                    ,$created_by
                            ");
  return $result;
}

function up_cif_list_accounts($customer_id)
{
  $result        = DB::select("
                                EXECUTE up_cif_list_accounts
                                    $customer_id
                            ");
  return $result;
}

function up_teller_list_of_transaction($institute_id)
{
  $result        = DB::select("
                                EXECUTE up_teller_list_of_transaction
                                    $institute_id
                            ");

  // return collect($result);
  return $result;
}

function up_trx_salary_deduction_bmmb($userId)
{
  DB::update('EXECUTE FMS.up_trx_salary_deduction_bmmb');
}

//function insert dividen share
function up_div_share_list(

  $profit = null,
  $id = null
) {
  //dd($id);
  if (is_null($profit) or $profit == '') {
    return 'Profit is empty';
  }

  $result        = DB::update(
    'SET NOCOUNT ON;
                                EXEC FMS.up_div_share_list ?,?',
    [
      $profit,
      $id
    ]
  );
}

//function insert dividen contribution
function up_div_cont_list(

  $profit_cont = null,
  $id = null
) {
  //dd($profit_cont);
  if (is_null($profit_cont) or $profit_cont == '') {
    return 'Profit is empty';
  }

  $result        = DB::update(
    'SET NOCOUNT ON;
                                EXEC FMS.up_div_cont_list ?,?',
    [
      $profit_cont,
      $id

    ]
  );
}

//function insert share bonus
function up_div_share_bonus_list(

  $profit_share_bonus = null,
  $id = null
) {
  //dd($profit_cont);
  if (is_null($profit_share_bonus) or $profit_share_bonus == '') {
    return 'Profit is empty';
  }

  $result        = DB::update(
    'SET NOCOUNT ON;
                                EXEC FMS.up_div_share_bonus_list ?,?',
    [
      $profit_share_bonus,
      $id

    ]
  );
}

//function insert reschedule finance
function up_upd_reschedule(
  $client_id,
  $account_no,
  $user_id,
  $resched_amt
) {
  $result        = DB::update(
    'SET NOCOUNT ON;
                                EXEC FMS.up_upd_reschedule ?,?,?,?',
    [
      $client_id,
      $account_no,
      $user_id,
      $resched_amt
    ]
  );
}

//function insert reschedule finance
function up_insert_repay_sched_rescdule(
  $client_id,
  $account_no,
  $user_id,
  $resched_amt,
  $datetime
) {
  $result        = DB::update(
    'SET NOCOUNT ON;
                                EXEC FMS.up_insert_repay_sched_rescdule ?,?,?,?,?',
    [
      $client_id,
      $account_no,
      $user_id,
      $resched_amt,
      $datetime
    ]
  );
}

//function insert final dividend
function up_div_final(
  $start_date
) {
  //dd($start_date,$end_date);
  $result        = DB::update('SET NOCOUNT ON;
                                EXEC FMS.up_div_final ?', [$start_date]);
}


//function insert share bonus
function up_trx_dividend_in(

  $id = null
) {
  //dd($id);
  if (is_null($id) or $id == '') {
    return 'id is empty';
  }

  $result        = DB::update(
    'SET NOCOUNT ON;
                                EXEC FMS.up_trx_dividend_in ?',
    [
      $id

    ]
  );
}

//function trx dividend bonus
function up_trx_dividend_bonus(
  $start_date = null,
  $id = null
) {
  //dd($start_date,$id);
  if (is_null($start_date) or $start_date == '') {
    return 'Declare Date is Empty';
  }

  $result        = DB::update(
    'SET NOCOUNT ON;
                                EXEC FMS.up_trx_dividend_bonus ?,?',
    [
      $start_date, $id

    ]
  );
}


//function trx dividend bonus
function up_trx_dividend_out(

  $mbrno = null,
  $txn_amt = null,
  $txn_date = null,
  $txn_code = null,
  $remarks = null,
  $user_id = null,
  $exec_seq_no = null,
  $bank_kopura = null

) {
  //dd($mbrno,$txn_amt,$txn_date,$txn_code,$remarks,$user_id,$exec_seq_no,$bank_kopura);
  if (is_null($mbrno) or $mbrno == '') {
    return 'membership no is empty';
  }

  if (is_null($txn_amt) or $txn_amt == '') {
    return 'Transaction Amount is empty';
  }

  if (is_null($txn_date) or $txn_date == '') {
    return 'Transaction Date is empty';
  }

  if (is_null($txn_code) or $txn_code == '') {
    return 'Transaction Code is empty';
  }

  if (is_null($remarks) or $remarks == '') {
    return 'Remarks is empty';
  }

  if (is_null($user_id) or $user_id == '') {
    return 'Username is empty';
  }
  if (is_null($bank_kopura) or $bank_kopura == '') {
    return 'Bank Koputra is empty';
  }

  $result        = DB::update(
    'SET NOCOUNT ON;
                                EXEC FMS.up_trx_dividend_out ?,?,?,?,?,?,?,?',
    [
      $mbrno, $txn_amt, $txn_date, $txn_code, $remarks, $user_id, $exec_seq_no, $bank_kopura

    ]
  );
}

//thirdpart contribution
function up_trx_thirdparty_contribution(
  $mbrno,
  $institution_code,
  $payment_mode,
  $transactionAmt,
  $txn_date,
  $doc_no,
  $bank_id,
  $cheque_no,
  $cheque_date,
  $remarks,
  $user_id,
  $mode

) {
  //dd($mbrno,$institution_code,$payment_mode,$transactionAmt,$txn_date,$doc_no,$bank_id,$cheque_no,$cheque_date,$remarks,$user_id,$mode);
  $result        = DB::update(
    'SET NOCOUNT ON;
                                EXEC FMS.up_trx_thirdparty_contribution ?,?,?,?,?,?,?,?,?,?,?,?',
    [
      $mbrno, $institution_code, $payment_mode, $transactionAmt, $txn_date, $doc_no, $bank_id, $cheque_no, $cheque_date, $remarks, $user_id, $mode

    ]
  );
}

//misc out
function up_trx_misc_out(
  $mbrno,
  $txn_amt,
  $txn_date,
  $type,
  $remarks,
  $doc_no,
  $user_id,
  $bank_members, //out to members
  $account_no, //out to financing
  $institution_code, //out to third party
  $bank_koputra

) {
  //dd($mbrno,$txn_amt,$txn_date,$type,$remarks,$doc_no,$user_id,$bank_members,$account_no,$institution_code,$bank_koputra);
  $result   = DB::update(
    'SET NOCOUNT ON;
                                EXEC FMS.up_trx_misc_out ?,?,?,?,?,?,?,?,?,?,?',
    [
      $mbrno, $txn_amt, $txn_date, $type, $remarks, $doc_no, $user_id, $bank_members, $account_no, $institution_code, $bank_koputra

    ]
  );
}


//BATCH RUN GL MONTHLY
function gl_batch_monthly(
  $report_date,
  $user_id

) {
  if (is_null($report_date) or $report_date == '') {
    return 'report date is empty';
  }
  //dd($report_date,$user_id);
  $result   = DB::update(
    'SET NOCOUNT ON;
                            EXEC FMS.up_acctg_gl_extract_main ?,?',
    [
      $report_date, $user_id
    ]
  );
}

//CONTRIBUTION REVERSAL
function up_trx_rvs_contribution(
  $mbr_id,
  $amount,
  $transaction_date,
  $remarks,
  $bank_id,
  $cheque_date,
  $bank_koputra,
  $user_id,
  $trx_id,
  $doc_no,
  $id_rvs,
  $id_msg
) {

  //dd($mbr_id,$amount,$transaction_date,$remarks,$bank_id,$cheque_date,$bank_koputra,$user_id,$trx_id,$doc_no,$id_rvs,$id_msg);

  DB::update('EXECUTE FMS.up_trx_rvs_contribution ?,?,?,?,?,?,?,?,?,?,?,?', [
    $mbr_id,
    $amount,
    $transaction_date,
    $remarks,
    $bank_id,
    $cheque_date,
    $bank_koputra,
    $user_id,
    $trx_id,
    $doc_no,
    $id_rvs,
    $id_msg
  ]);
}

//SHARES REVERSAL
function up_trx_rvs_shares(
  $mbr_id,
  $amount,
  $transaction_date,
  $remarks,
  $user_id,
  $trx_id,
  $id_rvs,
  $id_msg
) {

  //dd($mbr_id,$amount,$transaction_date,$remarks,$user_id,$trx_id,$id_rvs,$id_msg);

  DB::update('EXECUTE FMS.up_trx_rvs_shares ?,?,?,?,?,?,?,?', [
    $mbr_id,
    $amount,
    $transaction_date,
    $remarks,
    $user_id,
    $trx_id,
    $id_rvs,
    $id_msg
  ]);
}

//OTHERS PAYMENT REVERSAL
function up_trx_rvs_otherPmt(
  $mbr_id,
  $amount,
  $transaction_date,
  $remarks,
  $user_id,
  $trx_id,
  $doc_no,
  $bank_id,
  $bank_acctno,
  $id_rvs,
  $id_msg
) {

  //dd($mbr_id,$amount,$transaction_date,$remarks,$user_id,$trx_id,$doc_no,$bank_id,$bank_acctno,$id_rvs,$id_msg);

  DB::update('EXECUTE FMS.up_trx_rvs_others ?,?,?,?,?,?,?,?,?,?,?', [
    $mbr_id,
    $amount,
    $transaction_date,
    $remarks,
    $user_id,
    $trx_id,
    $doc_no,
    $bank_id,
    $bank_acctno,
    $id_rvs,
    $id_msg
  ]);
}

//MISC REVERSAL
function up_trx_rvs_misc(
  $mbr_id,
  $amount,
  $transaction_date,
  $remarks,
  $bank_koputra,
  $user_id,
  $trx_id,
  $doc_no,
  $id_rvs,
  $id_msg,
  $bank_members
) {

  //dd($mbr_id,$amount,$transaction_date,$remarks,$bank_koputra,$user_id,$trx_id,$doc_no,$id_rvs,$id_msg,$bank_members);

  DB::update('EXECUTE FMS.up_trx_rvs_misc ?,?,?,?,?,?,?,?,?,?,?', [
    $mbr_id,
    $amount,
    $transaction_date,
    $remarks,
    $bank_koputra,
    $user_id,
    $trx_id,
    $doc_no,
    $id_rvs,
    $id_msg,
    $bank_members
  ]);
}

//THIRD PARTY REVERSAL
function up_trx_rvs_thirdparty(
  $mbr_id,
  $amount,
  $transaction_date,
  $remarks,
  $bank_id,
  $cheque_date,
  $bank_koputra,
  $user_id,
  $doc_no,
  $institution_code,
  $payment_mode,
  $cheque_no,
  //$mode,
  $trx_id,
  $id_rvs,
  $id_msg,
  $mode_desc
) {

  //dd($mbr_id, $amount, $transaction_date, $remarks, $bank_id, $cheque_date, $bank_koputra, $user_id, $doc_no, $institution_code, $payment_mode, $cheque_no, //$mode,
  //$trx_id, $id_rvs, $id_msg, $mode_desc);

  DB::update('EXECUTE FMS.up_trx_rvs_thirdparty ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', [
    $mbr_id,
    $amount,
    $transaction_date,
    $remarks,
    $bank_id,
    $cheque_date,
    $bank_koputra,
    $user_id,
    $doc_no,
    $institution_code,
    $payment_mode,
    $cheque_no,
    //$mode,
    $trx_id,
    $id_rvs,
    $id_msg,
    $mode_desc
  ]);
}

//DIVIDEND OUT REVERSAL
function up_trx_rvs_dividend_out(
  $mbr_id,
  $amount,
  $transaction_date,
  $remarks,
  $bank_koputra,
  $user_id,
  $trx_id,
  $doc_no,
  $id_rvs,
  $id_msg
) {

  //dd($mbr_id, $amount, $transaction_date, $remarks, $bank_koputra, $user_id, $trx_id, $doc_no, $id_rvs, $id_msg);

  DB::update('EXECUTE FMS.up_trx_rvs_dividend_out ?,?,?,?,?,?,?,?,?,?', [
    $mbr_id,
    $amount,
    $transaction_date,
    $remarks,
    $bank_koputra,
    $user_id,
    $trx_id,
    $doc_no,
    $id_rvs,
    $id_msg
  ]);
}

// refund advance to members
function up_trx_3950_refund_advance(
  $account_no,
  $txn_amt,
  $txn_date,
  $txn_code,
  $remarks,
  $doc_no,
  $user_id,
  $bank_members,
  $bank_koputra
) {
  //dd($account_no,$txn_amt,$txn_date,$txn_code,$remarks,$doc_no,$user_id,$bank_members,$bank_koputra);
  DB::update('EXECUTE FMS.up_trx_3950_refund_advance ?,?,?,?,?,?,?,?,?', [
    $account_no,
    $txn_amt,
    $txn_date,
    $txn_code,
    $remarks,
    $doc_no,
    $user_id,
    $bank_members,
    $bank_koputra
  ]);
}

//Adv Reversal
function up_trx_rvs_3950_refund_advance(
  $account_no,
  $amount,
  $txn_date,
  $remarks,
  $bank_koputra,
  $user_id,
  $trx_code,
  $doc_no,
  $rvs_id,
  $id_msg

) {
  //dd($account_no,$amount,$txn_date,$remarks,$bank_koputra,$user_id,$trx_code,$doc_no,$rvs_id,$id_msg);
  DB::update('EXECUTE FMS.up_trx_rvs_3950_refund_advance ?,?,?,?,?,?,?,?,?,?', [
    $account_no,
    $amount,
    $txn_date,
    $remarks,
    $bank_koputra,
    $user_id,
    $trx_code,
    $doc_no,
    $rvs_id,
    $id_msg
  ]);
}

//Disb Reversal
function up_trx_rvs_disburse(
  $account_no,
  $transaction_date,
  $remarks,
  $user_id,
  $id_msg,
  $ids
) {
  //dd($account_no,$transaction_date,$remarks,$user_id,$id_msg,$ids);

  DB::update('EXECUTE FMS.up_trx_rvs_disburse ?,?,?,?,?,?', [
    $account_no,
    $transaction_date,
    $remarks,
    $user_id,
    $id_msg,
    $ids
  ]);
}

//fin Reversal
function up_trx_rvs_fin_instal(
  $mbr_no,
  $account_no,
  $amount,
  $transaction_date,
  $remarks,
  $user_id,
  $txn_code,
  $ids,
  $id_msg
) {

  //dd($mbr_no,$account_no,$amount,$transaction_date,$remarks,$user_id,$txn_code,$ids,$id_msg);

  DB::update('EXECUTE FMS.up_trx_rvs_fin_instal ?,?,?,?,?,?,?,?,?', [
    $mbr_no,
    $account_no,
    $amount,
    $transaction_date,
    $remarks,
    $user_id,
    $txn_code,
    $ids,
    $id_msg
  ]);
}

//payment misc
function up_trx_misc_in_bk(
  $ref_no,
  $txn_amt,
  $transaction_date,
  $transaction_code_id,
  $remarks,
  $oid,
  $thirdparty_code,
  $bank_koputra
  //$bank_id
  // $payment_mode,
  // $type
) {
  //dd($ref_no,$txn_amt,$transaction_date,$transaction_code_id,$remarks,$oid,$thirdparty_code,$bank_koputra);

  DB::update('EXECUTE fms.up_trx_misc_in_bk ?,?,?,?,?,?,?,?', [
    $ref_no,
    $txn_amt,
    $transaction_date,
    $transaction_code_id,
    $remarks,
    $oid,
    $thirdparty_code,
    $bank_koputra,
    //$bank_id,
    // $payment_mode,
    // $type
  ]);
}

//payment early settle one payment
function up_trx_rvs_1_settlemt(
  $account_no,
  $transaction_date,
  $remarks,
  $user_id,
  $id_msg,
  $ids
) {
  //dd($account_no,$transaction_date,$remarks,$user_id,$id_msg,$ids);

  DB::update('EXECUTE fms.up_trx_rvs_1_settlemt ?,?,?,?,?,?', [
    $account_no,
    $transaction_date,
    $remarks,
    $user_id,
    $id_msg,
    $ids
  ]);
}

//payment early settle one payment
function up_trx_3920_overlapping(
  $siskop_account,
  $settlement_amount,
  $transaction_code_id,
  $doc_no,
  $txn_date,
  $user_id,
  $remarks,
  $bank_koputra
) {
  //dd($siskop_account,$settlement_amount,$transaction_code_id,$doc_no,$txn_date,$user_id,$remarks,$bank_koputra);

  DB::update('EXECUTE fms.up_trx_3920_overlapping ?,?,?,?,?,?,?,?', [
    $siskop_account,
    $settlement_amount,
    $transaction_code_id,
    $doc_no,
    $txn_date,
    $user_id,
    $remarks,
    $bank_koputra
  ]);
}
