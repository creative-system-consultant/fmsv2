<?php

namespace App\Models\Fms;

use App\Models\Ref\RefTransactionCode;
use App\Models\Fms\FmsAccountMaster;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsAccountStatement extends Model
{
    use HasFactory;
    use HasFactory;

    protected $table   = 'FMS.ACCOUNT_STATEMENTS';
    protected $guarded = [];

    public function transaction_code()
    {
        return $this->belongsTo(RefTransactionCode::class, 'transaction_code_id', 'id');
    }

    public function accountMaster()
    {
        return $this->belongsTo(FmsAccountMaster::class, 'account_no', 'account_no');
    }
}
