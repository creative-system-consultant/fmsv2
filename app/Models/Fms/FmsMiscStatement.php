<?php

namespace App\Models\Fms;

use App\Models\Ref\RefTransactionCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsMiscStatement extends Model
{
    use HasFactory;
    protected $table   = 'FMS.MISC_STATEMENTS';
    protected $guarded = [];

    public function transaction()
    {
        return $this->belongsTo(RefTransactionCode::class, 'transaction_code_id', 'id');
    }
}
