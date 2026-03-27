<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    protected $fillable = ['titulo', 'descripcion', 'fecha_entrega', 'grupo_id', 'user_id'];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class);
    }

    public function maestro()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function entregas()
    {
        return $this->hasMany(Entrega::class);
    }
}