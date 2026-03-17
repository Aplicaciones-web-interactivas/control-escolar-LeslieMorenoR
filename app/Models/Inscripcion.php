<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    protected $table = 'inscripciones';
    protected $fillable = ['grupo_id', 'user_id'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function alumno()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}