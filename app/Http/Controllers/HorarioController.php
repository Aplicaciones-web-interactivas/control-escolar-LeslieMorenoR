<?php
namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Grupo;

class HorarioController extends Controller
{
    public function index()
    {
        $horarios = Horario::with(['materia', 'maestro'])->get();
        return view('horarios.index', compact('horarios'));
    }

    public function create()
    {
        $materias = Materia::all();
        $maestros = User::where('role', 'teacher')->get();
        return view('horarios.create', compact('materias', 'maestros'));
    }

public function store(Request $request)
{
    $request->validate([
        'materia_id'  => 'required|exists:materias,id',
        'user_id'     => 'required|exists:users,id',
        'hora_inicio' => 'required',
        'hora_fin'    => 'required',
        'dias'        => 'required|array',
    ]);

    // Verificar colisión de horarios del maestro
    $diasNuevos = $request->dias;

    $colision = Horario::where('user_id', $request->user_id)
        ->where(function ($query) use ($request) {
            $query->where('hora_inicio', '<', $request->hora_fin)
                  ->where('hora_fin', '>', $request->hora_inicio);
        })
        ->get()
        ->filter(function ($horario) use ($diasNuevos) {
            $diasExistentes = explode(',', $horario->dias);
            // Verificar si comparten al menos un día
            return count(array_intersect($diasNuevos, $diasExistentes)) > 0;
        });

    if ($colision->isNotEmpty()) {
        return back()->withErrors([
            'colision' => 'El maestro ya tiene una clase en ese horario y día.'
        ])->withInput();
    }

    // Crear el horario
    $horario = Horario::create([
        'materia_id'  => $request->materia_id,
        'user_id'     => $request->user_id,
        'hora_inicio' => $request->hora_inicio,
        'hora_fin'    => $request->hora_fin,
        'dias'        => implode(',', $request->dias),
    ]);

    // Crear el grupo automáticamente
    $materia = Materia::find($request->materia_id);
    Grupo::create([
        'nombre'     => $materia->clave . '-' . strtoupper(substr($request->dias[0], 0, 1)),
        'horario_id' => $horario->id,
    ]);

    return redirect()->route('horarios.index')->with('success', 'Horario y grupo creados correctamente');
}   
    public function destroy(Horario $horario)
    {
        $horario->delete();
        return redirect()->route('horarios.index')->with('success', 'Horario eliminado');
    }
}