<?php

namespace App\Models\Cif;

use App\Models\Ref\RefCountry;
use App\Models\Ref\RefState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table   = 'CIF.ADDRESSES';
    protected $guarded = [];

    public function state()
    {
        return $this->belongsTo(RefState::class, 'def_state_id', 'id');
    }

    public function country()
    {
        return $this->belongsTo(RefCountry::class, 'def_country_id', 'id');
    }
}
