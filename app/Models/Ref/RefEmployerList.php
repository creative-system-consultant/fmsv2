<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefEmployerList extends Model
{
    use HasFactory;

    protected $connection = 'fms';
    protected $table = 'REF.EMPLOYER_LIST';
    protected $guarded = [];
}
