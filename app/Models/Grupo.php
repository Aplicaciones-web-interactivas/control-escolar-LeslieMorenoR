<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Grupo extends Model
{
    protected $table = 'grupos';
    protected $fillable = ['nombre', 'horario_id'];

    public function horario()
    {
        return $this->belongsTo(Horario::class, 'horario_id');
    }

    public function alumnos()
    {
        return $this->belongsToMany(User::class, 'inscripciones', 'grupo_id', 'user_id')
                    ->withTimestamps();
    }

    public function calificaciones()
    {
        return $this->hasMany(Calificacion::class, 'grupo_id');
    }
}