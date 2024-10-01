@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 4rem;" class="my-4">Dashboard del estudiante</h1>
    <p>Bienvenido, {{ Auth::user()->name }}. Aquí puedes ver los cursos que has comprado.</p>
    <h2 style="font-family: 'Times New Roman', Times, serif; font-size: 1.5rem;" class="my-4 text-black">Ahora puedes visualizar el contenido de tus curso</h2>
    <hr>
    <!-- Sección de cursos con fondo gris -->
    <div class="courses-section" style="background-color: #f0f0f0; padding: 20px; border-radius: 10px;">
        <div class="row">
            @foreach($courses as $course)
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="card h-100">
                        @if($course->imagen)
                            <img class="card-img-top" src="{{ asset('storage/' . $course->imagen) }}" alt="Imagen del curso">
                        @endif
                        <div class="card-body">
                            <h4 class="card-title">{{ $course->titulo }}</h4>
                            <p class="card-text">{{ Str::limit($course->descripcion, 100) }}</p>
                            <p><strong>Precio:</strong> ${{ $course->precio }}</p>
                            <p><strong>Duración:</strong> {{ $course->duracion }} horas</p>
                        </div>
                        <div class="card-footer text-center">
                            <a href="{{ route('courses.show', $course->id) }}" class="btn btn-primary">Ver Curso</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
