<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Ref\RefClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use \OwenIt\Auditing\Auditable;

    protected $table = 'FMS.users';
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function getClientSpecificRoles($clientId)
    {
        return $this->roles()->wherePivot('client_id', $clientId)->get();
    }

    public function hasClientSpecificPermission($permission, $clientId)
    {
        $roles = $this->getClientSpecificRoles($clientId);

        foreach ($roles as $role) {
            if ($role->hasPermissionTo($permission)) {
                return true;
            }
        }

        return false;
    }

    public function clients()
    {
        return $this->belongsToMany(RefClient::class, 'REF.USER_HAS_CLIENTS', 'user_id', 'client_id');
    }

    public function refClient()
    {
        return $this->hasOne(RefClient::class, 'id', 'client_id');
    }
}
