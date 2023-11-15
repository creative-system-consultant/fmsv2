<?php

namespace App\Models\Ref;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RefUserHasClients extends Pivot
{
    use HasFactory;

    protected $table   = 'REF.USER_HAS_CLIENTS';
    protected $guarded = [];
}
