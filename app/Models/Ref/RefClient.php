<?php

namespace App\Models\Ref;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefClient extends Model
{
    use HasFactory;

    protected $table   = 'REF.CLIENT';
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class,'REF.USER_HAS_CLIENTS', 'client_id', 'user_id');
    }

    public function clientType()
    {
        return $this->hasOne(RefClientType::class, 'id', 'type_id');
    }
}
