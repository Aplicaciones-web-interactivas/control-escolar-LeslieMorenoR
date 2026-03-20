<?php
namespace App\Http\Controllers;

use App\Models\Grupo;
use App\Models\Horario;
use Illuminate\Http\Request;

class GrupoController extends Controller
{
    public function index()
    {
        $grupos = Grupo::with(['horario.materia', 'horario.maestro'])->get();
        return view('grupos.index', compact('grupos'));
    }

    public function create()
    {
        $horarios = Horario::with(['materia', 'maestro'])->get();
        return view('grupos.create', compact('horarios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'     => 'required|string|max:255',
            'horario_id' => 'required|exists:horarios,id',
        ]);

        Grupo::create($request->only('nombre', 'horario_id'));
        return redirect()->route('grupos.index')->with('success', 'Grupo creado correctamente');
    }

    public function destroy(Grupo $grupo)
    {
        $grupo->delete();
        return redirect()->route('grupos.index')->with('success', 'Grupo eliminado');
    }
}