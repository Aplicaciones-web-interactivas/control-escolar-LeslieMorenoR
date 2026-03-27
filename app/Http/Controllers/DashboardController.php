<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Horario;
use App\Models\Grupo;
use App\Models\Tarea;
use App\Models\Inscripcion;
use App\Models\Calificacion;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();


        if ($user->role === 'teacher') {
            $data = [
                'grupos'  => Grupo::whereHas('horario', fn($q) => $q->where('user_id', $user->id))->count(),
                'tareas'  => Tarea::where('user_id', $user->id)->count(),
                'alumnos' => Inscripcion::whereIn('grupo_id',
                    Grupo::whereHas('horario', fn($q) => $q->where('user_id', $user->id))->pluck('id')
                )->distinct('user_id')->count(),
            ];
            return view('dashboard.teacher', $data);
        }

        // Alumno
        $data = [
            'inscripciones'  => Inscripcion::where('user_id', $user->id)->count(),
            'calificaciones' => Calificacion::where('user_id', $user->id)->count(),
            'tareas'         => Tarea::whereIn('grupo_id',
                Inscripcion::where('user_id', $user->id)->pluck('grupo_id')
            )->count(),
        ];
        return view('dashboard.student', $data);
    }
}