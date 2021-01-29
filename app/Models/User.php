<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'last_name',
        'nickname',
        'email',
        'password',
        'image',
        'ruc',
        'bussiness_name',
        'bussiness_address',
        'bussiness_description'
    ];

    const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';
    private const ROLES_HIERARCHY = [
        self::ROLE_ADMIN => [self::ROLE_USER],
        self::ROLE_USER => []
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public function books()
    {
        return $this->hasMany('App\Models\Book');
    }

    public function chat1()
    {
        return $this->hasMany('App\Models\Chat', 'user_id1' );
    }

    public function chat2()
    {
        return $this->hasMany('App\Models\Chat', 'user_id2');
    }

    public function isGranted($role)
    {
        return $role === $this->role || in_array($role,self::ROLES_HIERARCHY[$this->role]);
    }

}

