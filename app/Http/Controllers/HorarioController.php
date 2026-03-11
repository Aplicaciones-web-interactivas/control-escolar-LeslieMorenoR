<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::with(['materia', 'maestro'])->get();
        return response()->json($horarios);
    }

    public function store(Request $request)
    {
        $request->validate([
            'materia_id'  => 'required|exists:materias,id',
            'user_id'     => 'required|exists:users,id',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin'    => 'required|date_format:H:i|after:hora_inicio',
            'dias'        => 'required|string',
        ]);

        $horario = Horario::create($request->all());
        return response()->json($horario, 201);
    }

    public function show(Horario $horario)
    {
        return response()->json($horario->load(['materia', 'maestro']));
    }

    public function update(Request $request, Horario $horario)
    {
        $horario->update($request->all());
        return response()->json($horario);
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();
        return response()->json(['message' => 'Horario eliminado']);
    }
}