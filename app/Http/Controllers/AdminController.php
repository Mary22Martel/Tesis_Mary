<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Canasta;
use App\Models\Categoria;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $this->authorizeRoles(['admin']);

        $categorias = Categoria::all();
        $canastas = Canasta::all(); 

        return view('admin.dashboard', compact('categorias', 'canastas'));
    }

    private function authorizeRoles($roles)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            abort(403, 'No tienes autorización para acceder a esta página.');
        }
    }
}

