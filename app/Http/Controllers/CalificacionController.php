<?php

namespace App\Http\Controllers;

use App\Models\Calificacion;
use Illuminate\Http\Request;

class CalificacionController extends Controller
{
    public function index()
    {
        $calificaciones = Calificacion::with(['grupo', 'alumno'])->get();
        return response()->json($calificaciones);
    }

    public function store(Request $request)
    {
        $request->validate([
            'grupo_id'     => 'required|exists:grupos,id',
            'user_id'      => 'required|exists:users,id',
            'calificacion' => 'required|numeric|min:0|max:10',
        ]);

        $calificacion = Calificacion::updateOrCreate(
            ['grupo_id' => $request->grupo_id, 'user_id' => $request->user_id],
            ['calificacion' => $request->calificacion]
        );

        return response()->json($calificacion, 201);
    }

    public function show(Calificacion $calificacion)
    {
        return response()->json($calificacion->load(['grupo', 'alumno']));
    }

    public function destroy(Calificacion $calificacion)
    {
        $calificacion->delete();
        return response()->json(['message' => 'Calificación eliminada']);
    }
}