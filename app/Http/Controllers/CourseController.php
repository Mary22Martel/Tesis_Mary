<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        if (Auth::user()->role != 'teacher') {
            return redirect('/home')->with('error', 'No tienes permiso para acceder a esta página.');
        }
        return view('courses.create');
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'teacher') {
            return redirect('/home')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image',
            'duracion' => 'required|integer',
            'precio' => 'required|numeric',
        ]);

        $course = new Course();
        $course->titulo = $request->titulo;
        $course->descripcion = $request->descripcion;
        $course->duracion = $request->duracion;
        $course->precio = $request->precio;
        $course->user_id = Auth::id();

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('courses', 'public');
            $course->imagen = $path;
        }
        $course->save();
        return redirect()->route('teacher.dashboard');
    }

    public function show(Course $course)
    {
        $hasPurchased = false;
    
        if (Auth::check() && Auth::user()->role == 'student') {
            $hasPurchased = Purchase::where('user_id', Auth::id())
                                    ->where('course_id', $course->id)
                                    ->exists(); 
        }
    
        return view('courses.show', compact('course', 'hasPurchased'));
    }
    

    public function edit(Course $course)
    {
        if (Auth::user()->role != 'teacher') {
            return redirect('/home')->with('error', 'No tienes permiso para acceder a esta página.');
        }

        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        if (Auth::user()->role != 'teacher') {
            return redirect('/home')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image',
            'duracion' => 'required|integer',
            'precio' => 'required|numeric',
        ]);

        $course->titulo = $request->titulo;
        $course->descripcion = $request->descripcion;
        $course->duracion = $request->duracion;
        $course->precio = $request->precio;

        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('courses', 'public');
            $course->imagen = $path;
        }

        $course->save();

        return redirect()->route('teacher.dashboard');
    }

    public function destroy(Course $course)
    {
        if (Auth::user()->role != 'teacher') {
            return redirect('/home')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $course->delete();
        return redirect()->route('teacher.dashboard');
    }

    public function purchase(Course $course, Request $request)
    {
        if (Auth::user()->role != 'student') {
            return redirect('/home')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        // Verificar si el estudiante ya compró el curso solo si no hay confirmación de la compra repetida
        if (!$request->has('confirm') && Purchase::where('user_id', Auth::id())->where('course_id', $course->id)->exists()) {
            return redirect()->route('courses.show', $course->id)->with('info', 'Ya compraste este curso. ¿Estás seguro de que quieres volver a comprarlo?')->with('course_purchased', true);
        }

        return view('courses.purchase', compact('course'));
    }

    public function confirmPurchase(Request $request, Course $course)
    {
        if (Auth::user()->role != 'student') {
            return redirect('/home')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        // Registrar la compra en la base de datos
        Purchase::create([
            'user_id' => Auth::id(),
            'course_id' => $course->id,
        ]);

        return redirect()->route('courses.show', $course->id)->with('success', '¡Compra realizada con éxito!');
    }
    public function studentDashboard()
    {
        $user = Auth::user();
        $purchases = Purchase::where('user_id', $user->id)->get();
        $courses = $purchases->map(function($purchase) {
            return $purchase->course;
        });

        return view('student.dashboard', compact('courses'));
    }
}
