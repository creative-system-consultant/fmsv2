<?php

namespace App\Models\Siskop;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiskopAccountProduct extends Model
{
    use HasFactory;

    protected $table = 'SISKOP.ACCOUNT_PRODUCTS';
    protected $guarded = [];
}
