<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefThirdParty extends Model
{
    use HasFactory;

    protected $table   = 'REF.THIRDPARTY';
    protected $guarded = [];
}
