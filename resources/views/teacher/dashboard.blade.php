@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 3rem;">Dashboard del Profesor</h1>
    <p>Bienvenido, {{ Auth::user()->name }}. Aquí puedes gestionar tus cursos.</p>
    <div class="d-flex justify-content-between mb-4">
        <h2 style="font-family: 'Times New Roman', Times, serif; font-size: 1.5rem;">Estos son los cursos que has creado</h2>
        <a href="{{ route('courses.create') }}" class="btn btn-primary">Crear Nuevo Curso</a>
    </div>
    
    <hr>
    <div class="row">
        @foreach($courses as $course)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <a href="{{ route('courses.show', $course->id) }}">
                    @if($course->imagen)
                        <img class="card-img-top" src="{{ asset('storage/' . $course->imagen) }}" alt="Imagen del curso">
                    @else
                        <img class="card-img-top" src="{{ asset('default-course-image.jpg') }}" alt="Imagen por defecto">
                    @endif
                </a>
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="{{ route('courses.show', $course->id) }}">{{ $course->titulo }}</a>
                    </h4>
                    <p class="card-text">{{ Str::limit($course->descripcion, 100) }}</p>
                    <p><strong>Precio:</strong> ${{ $course->precio }}</p>
                    <p><strong>Duración:</strong> {{ $course->duracion }} horas</p>
                </div>
                <div class="card-footer">
                    <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
