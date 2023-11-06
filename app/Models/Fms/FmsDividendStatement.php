<?php

namespace App\Models\Fms;

use App\Models\Ref\RefTransactionCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsDividendStatement extends Model
{
    use HasFactory;
    protected $table   = 'FMS.DIVIDEN_STATEMENT';
    protected $guarded = [];

    public function TxnCode()
    {
        return $this->belongsTo(RefTransactionCode::class, 'transaction_code_id', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo(RefTransactionCode::class, 'transaction_code_id', 'id');
    }
}
