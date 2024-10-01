<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(Course $course)
    {
        if (Auth::user()->role != 'teacher' || Auth::id() != $course->user_id) {
            return redirect('/home')->with('error', 'No tienes permiso para acceder a esta página.');
        }

        return view('contents.create', compact('course'));
    }

    public function store(Request $request, Course $course)
{
    if (Auth::user()->role != 'teacher' || Auth::id() != $course->user_id) {
        return redirect('/home')->with('error', 'No tienes permiso para realizar esta acción.');
    }

    $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'tipo' => 'required|string|in:video,document',
        'archivo' => 'required|file',
    ]);

    $content = new Content();
    $content->course_id = $course->id;
    $content->titulo = $request->titulo;
    $content->descripcion = $request->descripcion;
    $content->tipo = $request->tipo;

    if ($request->hasFile('archivo')) {
        $file = $request->file('archivo');
        $path = $file->store('contents', 'public');
        $content->archivo = $path;
    }

    $content->save();

    return redirect()->route('courses.show', $course->id);
}

    public function edit(Content $content)
    {
        $course = $content->course;
        if (Auth::user()->role != 'teacher' || Auth::id() != $course->user_id) {
            return redirect('/home')->with('error', 'No tienes permiso para acceder a esta página.');
        }

        return view('contents.edit', compact('content', 'course'));
    }

    public function update(Request $request, Content $content)
    {
        $course = $content->course;
        if (Auth::user()->role != 'teacher' || Auth::id() != $course->user_id) {
            return redirect('/home')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'archivo' => 'nullable|file',
        ]);

        $content->titulo = $request->titulo;
        $content->descripcion = $request->descripcion;

        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $mimeType = $file->getMimeType();
            $path = $file->store('contents', 'public');
            $content->archivo = $path;

            if (strpos($mimeType, 'video') !== false) {
                $content->tipo = 'video';
            } else {
                $content->tipo = 'document';
            }
        }
        $content->save();

        return redirect()->route('courses.show', $course->id);
    }

    public function destroy(Content $content)
    {
        $course = $content->course;
        if (Auth::user()->role != 'teacher' || Auth::id() != $course->user_id) {
            return redirect('/home')->with('error', 'No tienes permiso para realizar esta acción.');
        }

        $content->delete();
        return redirect()->route('courses.show', $course->id);
    }
}
