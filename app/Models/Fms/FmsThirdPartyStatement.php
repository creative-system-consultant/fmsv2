<?php

namespace App\Models\Fms;

use App\Models\Ref\RefTransactionCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsThirdPartyStatement extends Model
{
    use HasFactory;
    protected $table = 'FMS.THIRDPARTY_STATEMENTS';
    protected $casts = [
        'transaction_date'  => 'datetime',
        'created_at'  => 'datetime',
    ];

    public function ThirdPartys()
    {
        return $this->hasMany(FmsThirdPartyStatement::class, 'transaction_code_id', 'id');
    }

    public function detail()
    {
        return $this->belongsTo(RefTransactionCode::class, 'transaction_code_id', 'id');
    }

    public function creator()
    {
        return $this->hasOne(FmsUser::class, 'id', 'created_by');
    }
}
