<?php

namespace App\Http\Controllers;

use App\Models\Grupo;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        $grupos = Grupo::with(['horario.materia', 'horario.maestro'])->get();
        return response()->json($grupos);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string',
            'horario_id' => 'required|exists:horarios,id',
        ]);

        $grupo = Grupo::create($request->all());
        return response()->json($grupo, 201);
    }

    public function show(Grupo $grupo)
    {
        return response()->json($grupo->load(['horario.materia', 'alumnos']));
    }

    public function update(Request $request, Grupo $grupo)
    {
        $grupo->update($request->all());
        return response()->json($grupo);
    }

    public function destroy(Grupo $grupo)
    {
        $grupo->delete();
        return response()->json(['message' => 'Grupo eliminado']);
    }
}