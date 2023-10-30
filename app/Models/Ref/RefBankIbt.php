<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefBankIbt extends Model
{
    use HasFactory;

    protected $table   = 'ref.banks_ibt';
    protected $guarded = [];
    protected $dates   = ['created_at', 'deleted_at', 'updated_at'];
}
