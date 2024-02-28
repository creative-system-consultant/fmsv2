<?php

namespace App\Models\Fms;

use App\Models\Ref\RefTransactionCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsOtherStatement extends Model
{
    use HasFactory;

    protected $table   = 'FMS.OTHER_PAYMENTS_STATEMENTS';
    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(RefTransactionCode::class, 'txn_code', 'id');
    }
}
