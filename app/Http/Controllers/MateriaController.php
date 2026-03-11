<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::all();
        return response()->json($materias);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'clave'  => 'required|string|unique:materias',
        ]);

        $materia = Materia::create($request->all());
        return response()->json($materia, 201);
    }

    public function show(Materia $materia)
    {
        return response()->json($materia);
    }

    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'nombre' => 'sometimes|string',
            'clave'  => 'sometimes|string|unique:materias,clave,' . $materia->id,
        ]);

        $materia->update($request->all());
        return response()->json($materia);
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();
        return response()->json(['message' => 'Materia eliminada']);
    }
}