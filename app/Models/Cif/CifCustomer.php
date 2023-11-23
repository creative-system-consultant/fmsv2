<?php

namespace App\Models\Cif;

use App\Models\Fms\FmsAccountMaster;
use App\Models\Fms\Membership;
use App\Models\Fms\FmsMembership;
use App\Models\Ref\RefState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CifCustomer extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table   = 'CIF.CUSTOMERS';
    protected $guarded = [];

    public function fmsMembership()
    {
        return $this->hasOne(FmsMembership::class, 'cif_id', 'id');
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'cif_id', 'id');
    }

    public function families()
    {
        return $this->hasMany(Family::class, 'cif_id', 'id');
    }

    public function membership()
    {
        return $this->belongsTo(Membership::class, 'id', 'cif_id');
    }
}
