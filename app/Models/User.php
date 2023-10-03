<?php

namespace App\Models;

use App\Enums\UserTypesEnum;
use App\Models\Base\User as BaseUser;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends BaseUser implements \Illuminate\Contracts\Auth\Authenticatable
{
    use HasApiTokens, HasFactory, Authenticatable, Notifiable;

    protected $hidden = [
        'password',
        'remember_token',
        'github_id',
        'github_token',
        'github_refresh_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'user_type' => UserTypesEnum::class,
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'user_type',
        'remember_token',
        'github_id',
        'github_token',
        'github_refresh_token',
        'github_profile_picture',
    ];
}
