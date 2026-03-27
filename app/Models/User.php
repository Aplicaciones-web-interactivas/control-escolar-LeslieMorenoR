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
    public function inscripciones()
{
    return $this->hasMany(Inscripcion::class, 'user_id');
}
// app/Models/User.php
public function grupos()
{
    return $this->belongsToMany(Grupo::class, 'inscripciones', 'user_id', 'grupo_id')
                ->withTimestamps();
}
}