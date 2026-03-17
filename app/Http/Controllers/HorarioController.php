<?php
namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Materia;
use App\Models\User;
use Illuminate\Http\Request;

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

        Horario::create([
            'materia_id'  => $request->materia_id,
            'user_id'     => $request->user_id,
            'hora_inicio' => $request->hora_inicio,
            'hora_fin'    => $request->hora_fin,
            'dias'        => implode(',', $request->dias),
        ]);

        return redirect()->route('horarios.index')->with('success', 'Horario creado correctamente');
    }

    public function destroy(Horario $horario)
    {
        $horario->delete();
        return redirect()->route('horarios.index')->with('success', 'Horario eliminado');
    }
}