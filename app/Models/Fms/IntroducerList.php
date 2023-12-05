<?php

namespace App\Models\Fms;

use App\Models\Cif\CifCustomer;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IntroducerList extends Model
{
    use HasFactory;

    protected $table   = 'FMS.INTRODUCER_LIST';
    protected $guarded = [];

    public function customer()
    {
        return $this->hasOne(CifCustomer::class, 'introducer_identityno', 'identity_no');
    }
}
