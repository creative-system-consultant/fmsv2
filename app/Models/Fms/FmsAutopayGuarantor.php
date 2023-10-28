<?php

namespace App\Models\Fms;

use App\Models\Ref\RefBankIbt;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FmsAutopayGuarantor extends Model
{
    use HasFactory;

    protected $connection = 'fms';
    protected $table   = 'FMS.AUTOPAY_GUARANTOR';
    protected $guarded = [];

    public function banks()
    {
        return $this->belongsTo(RefBankIbt::class, 'bank', 'id');
    }
}
