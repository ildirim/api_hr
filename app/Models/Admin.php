<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Models\Role;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Facades\JWTAuth;

class Admin extends Authenticatable implements JWTSubject
{
    use Notifiable, HasRoles;

    /**
     * Guard for the model
     *
     * @var string
     */
    protected $guard = 'admin';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'created_admin_id',
        'company_id',
        'first_name',
        'last_name',
        'email',
        'password',
        'phone',
        'profile_image',
        'status',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class, 'admin_id', 'id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public static function me(): array
    {
        $token = JWTAuth::getToken();
        return JWTAuth::getPayload($token)->toArray();
    }
}
