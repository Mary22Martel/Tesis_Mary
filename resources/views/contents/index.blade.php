@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Contenido del Curso: {{ $course->titulo }}</h1>
    <a href="{{ route('courses.contents.create', $course->id) }}" class="btn btn-primary mb-4">Añadir Contenido</a>
    <div class="row">
        @foreach($contents as $content)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="{{ route('contents.show', $content->id) }}">{{ $content->titulo }}</a>
                    </h4>
                    <p class="card-text">{{ Str::limit($content->descripcion, 100) }}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
