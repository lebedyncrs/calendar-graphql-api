<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'email', 'password', 'timezone'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getFullName()
    {
        return $this->name . ' ' . $this->surname;
    }

    public function calendars()
    {
        return $this->hasMany(Calendar::class, 'owner_id', 'id');
    }

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

    /**
     * Convert attribute to string data instead of Carbon object
     * @todo should handle timezone as well
     * @return string
     */
    public function getCreatedAtAttribute(): string
    {
        return $this->attributes['created_at'];
    }

    /**
     * Convert attribute to string data instead of Carbon object
     * @todo should handle timezone as well
     * @return string
     */
    public function getUpdatedAtAttribute(): string
    {
        return $this->attributes['created_at'];
    }
}
