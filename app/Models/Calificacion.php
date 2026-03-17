<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    protected $table = 'calificaciones';
    protected $fillable = ['grupo_id', 'user_id', 'calificacion'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function alumno()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}