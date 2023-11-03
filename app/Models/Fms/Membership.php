<?php

namespace App\Models\Fms;

use App\Models\Cif\CifCustomer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;
    protected $table   = 'FMS.MEMBERSHIP';
    protected $guarded = [];

    public function Customer()
    {
        return $this->belongsTo(CifCustomer::class, 'cif_id', 'id');
    }
}
