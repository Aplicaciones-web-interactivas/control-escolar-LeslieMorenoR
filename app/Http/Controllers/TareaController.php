<?php
namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\Entrega;
use App\Models\Grupo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TareaController extends Controller
{
    // Maestro ve sus tareas
    public function index()
    {
        $tareas = Tarea::with(['grupo.horario.materia'])
                    ->where('user_id', Auth::id())
                    ->get();
        return view('tareas.index', compact('tareas'));
    }

    // Maestro crea tarea
    public function create()
    {
        $grupos = Grupo::with(['horario.materia'])
                    ->whereHas('horario', fn($q) => $q->where('user_id', Auth::id()))
                    ->get();
        return view('tareas.create', compact('grupos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'        => 'required|string|max:255',
            'descripcion'   => 'required|string',
            'fecha_entrega' => 'required|date|after:today',
            'grupo_id'      => 'required|exists:grupos,id',
        ]);

        Tarea::create([
            'titulo'        => $request->titulo,
            'descripcion'   => $request->descripcion,
            'fecha_entrega' => $request->fecha_entrega,
            'grupo_id'      => $request->grupo_id,
            'user_id'       => Auth::id(),
        ]);

        return redirect()->route('tareas.index')->with('success', 'Tarea creada correctamente');
    }

    // Maestro ve entregas de una tarea
    public function show(Tarea $tarea)
    {
        $entregas = Entrega::where('tarea_id', $tarea->id)->with('alumno')->get();
        return view('tareas.show', compact('tarea', 'entregas'));
    }

    // Alumno ve sus tareas
    public function misTareas()
    {
        $gruposAlumno = Auth::user()->grupos()->pluck('grupos.id');
        $tareas = Tarea::with(['grupo.horario.materia'])
                    ->whereIn('grupo_id', $gruposAlumno)
                    ->get();
        $misEntregas = Entrega::where('user_id', Auth::id())->pluck('tarea_id');
        return view('tareas.mis_tareas', compact('tareas', 'misEntregas'));
    }

    // Alumno sube PDF
    public function entregar(Request $request)
    {
        $request->validate([
            'tarea_id' => 'required|exists:tareas,id',
            'archivo'  => 'required|file|mimes:pdf|max:10240', // max 5MB
        ]);

        $yaEntrego = Entrega::where('tarea_id', $request->tarea_id)
                            ->where('user_id', Auth::id())
                            ->exists();

        if ($yaEntrego) {
            return back()->withErrors(['error' => 'Ya entregaste esta tarea.']);
        }

        $ruta = $request->file('archivo')->store('entregas', 'public');

        Entrega::create([
            'tarea_id' => $request->tarea_id,
            'user_id'  => Auth::id(),
            'archivo'  => $ruta,
        ]);

        return back()->with('success', 'Tarea entregada correctamente.');
    }

    public function destroy(Tarea $tarea)
    {
        $tarea->delete();
        return redirect()->route('tareas.index')->with('success', 'Tarea eliminada');
    }
}