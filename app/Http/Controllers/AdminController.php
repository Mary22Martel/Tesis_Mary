<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\User;

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

        $coursesCount = Course::count();
        $usersCount = User::count();
        // Obtén otros datos necesarios para el dashboard aquí

        return view('admin.dashboard', compact('coursesCount', 'usersCount'));
    }

    private function authorizeRoles($roles)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            abort(403, 'No tienes autorización para acceder a esta página.');
        }
    }
}

