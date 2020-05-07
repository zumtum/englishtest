<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setSlugAttribute($value)
    {
        $this->attributes['name'] = Str::slug(explode('@', $this->email)[0]);
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'roles_users');
    }

    /**
     * @param array $permissions
     *
     * @return bool
     */
    public function hasAccess(array $permissions): bool
    {
        /** @var Role $role */
        foreach ($this->roles as $role) {
            if ($role->hasAccess($permissions)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $roleSlug
     *
     * @return bool
     */
    public function hasRole(string $roleSlug): bool
    {
        return $this->roles()->where('slug', $roleSlug)->count() === 1;
    }

    /**
     * @param string $roleSlug
     *
     * @return bool
     */
    public function hasRoles(array $rolesSlugs): bool
    {
        return $this->roles()->whereIn('slug', $rolesSlugs)->count() >= 1;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }
}
