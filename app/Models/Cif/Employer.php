<?php

namespace App\Models\Cif;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employer extends Model
{
    use HasFactory;

    protected $table   = 'CIF.CUSTOMER_EMPLOYER';
    protected $guarded = [];
}
