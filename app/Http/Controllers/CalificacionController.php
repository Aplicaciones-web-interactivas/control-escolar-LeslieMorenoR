<?php
namespace App\Http\Controllers;

use App\Models\Calificacion;
use App\Models\Grupo;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CalificacionController extends Controller
{
    // Maestro ve sus grupos para calificar
    public function index()
    {
        $grupos = Grupo::with(['horario.materia'])
                    ->whereHas('horario', fn($q) => $q->where('user_id', Auth::id()))
                    ->get();
        return view('calificaciones.index', compact('grupos'));
    }

    // Maestro ve alumnos de un grupo para calificar
  public function show($id)
{
    $grupo = Grupo::with(['horario.materia', 'horario.maestro'])->findOrFail($id);

    $inscripciones = Inscripcion::where('grupo_id', $grupo->id)
                        ->with('alumno')
                        ->get();

    $calificaciones = Calificacion::where('grupo_id', $grupo->id)
                        ->pluck('calificacion', 'user_id');

    return view('calificaciones.show', compact('grupo', 'inscripciones', 'calificaciones'));
}

    // Maestro guarda calificación
    public function store(Request $request)
    {
        $request->validate([
            'grupo_id'     => 'required|exists:grupos,id',
            'user_id'      => 'required|exists:users,id',
            'calificacion' => 'required|numeric|min:0|max:10',
        ]);

        Calificacion::updateOrCreate(
            ['grupo_id' => $request->grupo_id, 'user_id' => $request->user_id],
            ['calificacion' => $request->calificacion]
        );

        return back()->with('success', 'Calificación guardada.');
    }

    // Alumno ve sus calificaciones
    public function misCalificaciones()
    {
        $calificaciones = Calificacion::where('user_id', Auth::id())
                            ->with('grupo.horario.materia')
                            ->get();
        return view('calificaciones.mis_calificaciones', compact('calificaciones'));
    }
}