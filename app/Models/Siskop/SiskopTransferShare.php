<?php

namespace App\Models\Siskop;

use App\Models\Cif\CifCustomer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiskopTransferShare extends Model
{
    use HasFactory;

    protected $table = 'SISKOP.shares';
    protected $guarded = [];

    public function buyer()
    {
        return $this->belongsTo(CifCustomer::class, 'cust_id', 'id');
    }

    public function seller()
    {
        return $this->belongsTo(CifCustomer::class, 'seller_no', 'id');
    }
}
