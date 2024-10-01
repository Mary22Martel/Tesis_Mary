@extends('layouts.app')

@section('content')
<div class="container">
    <div class="jumbotron text-center">
        <h1 class="display-4">Compra Exitosa</h1>
        <p class="lead">Has comprado exitosamente el curso: <strong>{{ $course->titulo }}</strong></p>
        <hr class="my-4">
        <p>Puedes acceder a este curso desde tu <a href="{{ route('student.dashboard') }}">Dashboard del Estudiante</a>.</p>
        <a class="btn btn-primary btn-lg" href="{{ route('student.dashboard') }}" role="button">Ir a Mis Cursos</a>
    </div>
</div>
@endsection
