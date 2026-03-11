<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index()
    {
        $inscripciones = Inscripcion::with(['grupo', 'alumno'])->get();
        return response()->json($inscripciones);
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo_id' => 'required|exists:grupos,id',
            'user_id'  => 'required|exists:users,id',
        ]);

        // Verificar que no esté ya inscrito
        $existe = Inscripcion::where('grupo_id', $request->grupo_id)
                             ->where('user_id', $request->user_id)
                             ->exists();

        if ($existe) {
            return response()->json(['message' => 'El alumno ya está inscrito en este grupo'], 422);
        }

        $inscripcion = Inscripcion::create($request->all());
        return response()->json($inscripcion, 201);
    }

    public function destroy(Inscripcion $inscripcion)
    {
        $inscripcion->delete();
        return response()->json(['message' => 'Inscripción eliminada']);
    }
}