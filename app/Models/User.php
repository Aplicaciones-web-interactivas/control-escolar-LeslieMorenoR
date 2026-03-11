<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
protected $fillable = [
    'name',
    'institutional_key',
    'password',
    'role',
    'is_activate',
];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}