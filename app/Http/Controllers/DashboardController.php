<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Materia;
use App\Models\Horario;
use App\Models\Grupo;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'alumnos'  => User::where('role', 'student')->count(),
            'materias' => Materia::count(),
            'docentes' => User::where('role', 'teacher')->count(),
            'horarios' => Horario::count(),
            'grupos'   => Grupo::count(),
        ];

        return view('dashboard', $data);
    }
}