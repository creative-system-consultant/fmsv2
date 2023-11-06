<?php

namespace App\Models\Cif;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $table   = 'CIF.FAMILIES';
    protected $guarded = [];
}
