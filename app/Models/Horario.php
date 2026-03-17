<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    protected $table = 'horarios';
    protected $fillable = ['materia_id', 'user_id', 'hora_inicio', 'hora_fin', 'dias'];

    public function materia()
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }

    public function maestro()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function grupos()
    {
        return $this->hasMany(Grupo::class, 'horario_id');
    }
}