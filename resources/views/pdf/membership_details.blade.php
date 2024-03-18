<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PAYMENT VOUCHER</title>

    <style>
        body {
            background-color: white;
            font-family: Helvetica, Arial, Sans-Serif;
        }

        table {
            margin-bottom: 0rem !important;
        }

        #table {
            border-collapse: collapse;
            width: 100%;
            line-height: 0px;
        }

        #table td,
        #table th {
            padding-left: 6px;
            padding-right: 6px;
            padding-top: 2px;
            padding-bottom: 2px;
        }

        .font-bold {
            font-weight: 700;
        }

        .red {
            color: red;
        }

        p {
            font-size: 12px;
        }

        .boderTopBottom {
            border-bottom: 3px solid #696969;
            border-top: 3px solid #696969;
        }

        .boderTop {
            border-top: 3px solid #696969;
        }

        .text-xl {
            font-size: 14px;
        }

    </style>
</head>
<body>
    <main>
        {{-- <center>
            <img width="70%" src="{{ public_path('img/header.jpg') }}">
        </center> --}}
        <br><br>
        <div style="margin-left: 2rem; margin-right:2rem;">
            <table id="table" width="100%" align="center">
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <p class="font-bold">NAME :</p>
                    </td>
                    <td>
                        <p>{{$data->name}}</p>
                    </td>
                    <td>
                        <p class="font-bold">STAFF NO :</p>
                    </td>
                    <td>
                        <p>{{$data->staff_no}}</p>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <p class="font-bold">MEMBER ID :</p>
                    </td>
                    <td>
                        <p>{{ $data->mbr_no }}</p>
                    </td>
                    <td>
                        <p class="font-bold">IC NO :</p>
                    </td>
                    <td>
                        <p>{{ $data->identity_no }}</p>
                    </td>
                </tr>
                <tr>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
                <tr>
                    <td>
                        <p class="font-bold">DATE PRINT :</p>
                    </td>
                    <td>
                        <p>{{ now()->format('d/m/Y') }}</p>
                    </td>
                </tr>
            </table>
            <br><br>
            <center>
                <p class="font-bold">CLOSED MEMBERSHIP SUMMARY</p>
            </center>
            <table width="100%">
                <tr>
                    <th colspan="2" class="boderTopBottom" style='padding:10px;' align="left">Summary</th>
                </tr>
                <tr>
                    <td>
                        <p class="font-bold" align='left'>Total Shares</p>
                    </td>
                    <td>
                        <p class="font-bold" align='right'>{{ number_format($data->total_share,2) }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="font-bold" align='left'>Total Contributions</p>
                    </td>
                    <td>
                        <p class="font-bold" align='right'>{{ number_format($data->total_contribution,2) }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="font-bold" align='left'>Total Dividen</p>
                    </td>
                    <td>
                        <p class="font-bold" align='right'>{{ number_format($data->bal_dividen,2) ?? '' }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="font-bold" align='left'>Total Misc</p>
                    </td>
                    <td>
                        <p class="font-bold" align='right'>{{ number_format($data->misc_amt,2) ?? '' }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="font-bold" align='left'>Total Advance Payment</p>
                    </td>
                    <td>
                        <p class="font-bold" align='right'>{{ number_format($data->advance_payment,2) ?? '' }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="font-bold" align='left'>Total Savings</p>
                    </td>
                    <td>
                        <p class="font-bold" align='right'>0.00</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="font-bold" align='left'>Total Payable Amount Due</p>
                    </td>
                    <td>
                        <p class="font-bold" align='right'>{{ number_format($data->total_due,2) }}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p class="font-bold" align='left'>Retirement Fee</p>
                    </td>
                    <td>
                        <p class="font-bold" align='right'>10.00</p>
                    </td>
                </tr>
            </table>
            <table width="100%" style="margin-top: 20px;" class="boderTop">
                <tr>
                    <td>
                        <p class="text-xl font-bold" align='left'>AMOUNT DUE TO MEMBER</p>
                    </td>
                    <td>
                        <p class="font-bold" align='right'>{{ number_format($data->total_all,2) }}</p>
                    </td>
                </tr>
            </table>

            <table width="100%" style="margin-top:80px;">
                <tr>
                    <th align="left" style="padding-bottom: 70px;">PREPARED BY:</th>
                    <th align="left" style="padding-bottom: 70px;">VERIFIED BY:</th>
                    <th align="left" style="padding-bottom: 70px;">CERTIFIED BY:</th>
                </tr>
                <tr>
                    <td align="left">Signature<br>(Kerani)</td>
                    <td align="left">Signature<br>(Pegawai)</td>
                    <td align="left">Signature<br>(Pengurus)</td>
                </tr>
            </table>
        </div>
    </main>
</body>
</html>
