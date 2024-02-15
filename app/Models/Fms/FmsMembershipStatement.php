<?php

namespace App\Models\Fms;

use App\Models\Ref\RefTransactionCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsMembershipStatement extends Model
{
    use HasFactory;

    protected $table   = 'FMS.MEMBERSHIP_STATEMENTS';
    protected $guarded = [];

    public function transactionCode()
    {
        return $this->hasOne(RefTransactionCode::class, 'id','transaction_code_id');
    }
}
