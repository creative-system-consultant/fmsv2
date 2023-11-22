<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefClientType extends Model
{
    use HasFactory;

    protected $table   = 'REF.CLIENT_TYPES';
    protected $guarded = [];
}
