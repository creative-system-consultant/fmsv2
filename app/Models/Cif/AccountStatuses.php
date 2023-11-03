<?php

namespace App\Models\Cif;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountStatuses extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table   = 'CIF.ACCOUNT_STATUSES';
    protected $guarded = [];
}
