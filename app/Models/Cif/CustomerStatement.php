<?php

namespace App\Models\Cif;

use App\Models\Ref\RefTransactionCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerStatement extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'FMS.MEMBERSHIP_STATEMENTS';

    protected $casts = [
        'transaction_date'   => 'date:Y-m-d',
        'cheque_date'       => 'date:Y-m-d',
        'created_date'      => 'date:Y-m-d',
        'updated_date'      => 'date:Y-m-d',
        'deleted_date'      => 'date:Y-m-d',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customers', 'customer_id', 'id');
    }

    public function transaction()
    {
        return $this->belongsTo(RefTransactionCode::class, 'transaction_code_id', 'id');
    }

    public function bank()
    {
        return $this->belongsTo('App\Models\RefBankIBT', 'bank_koputra', 'id');
    }

    //format
    public function getDateAttribute()
    {
        return isset($this->transaction_date) ? $this->transaction_date->format('d/m/Y') : '';
    }
}
