<?php
namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InscripcionController extends Controller
{
    // Alumno ve los grupos disponibles
    public function index()
    {
        $grupos = Grupo::with(['horario.materia', 'horario.maestro'])->get();
        $misInscripciones = Inscripcion::where('user_id', Auth::id())->pluck('grupo_id');
        return view('inscripciones.index', compact('grupos', 'misInscripciones'));
    }

    // Alumno se inscribe
    public function store(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
        ]);

        $yaInscrito = Inscripcion::where('user_id', Auth::id())
                                 ->where('grupo_id', $request->grupo_id)
                                 ->exists();

        if ($yaInscrito) {
            return back()->withErrors(['error' => 'Ya estás inscrito en este grupo.']);
        }

        Inscripcion::create([
            'grupo_id' => $request->grupo_id,
            'user_id'  => Auth::id(),
        ]);

        return back()->with('success', 'Inscripción realizada correctamente.');
    }

    // Alumno cancela inscripción
    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();
        return back()->with('success', 'Inscripción cancelada.');
    }
}