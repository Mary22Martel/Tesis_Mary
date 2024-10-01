@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 3rem;" class="my-4 text-center">{{ $course->titulo }}</h1>
    <p class="text-center">{{ $course->descripcion }}</p>

    @if(Auth::check() && Auth::user()->role == 'teacher' && Auth::id() == $course->user_id)
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('courses.contents.create', $course->id) }}" class="btn btn-primary">Añadir Contenido</a>
        </div>
    @endif

    @foreach($course->contents as $content)
        <div class="card mb-3 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">{{ $content->titulo }}</h2>
                <p class="card-text">{{ $content->descripcion }}</p>

                @if($content->tipo == 'video')
                    <div class="embed-responsive embed-responsive-16by9 mb-3">
                        <video class="embed-responsive-item" controls>
                            <source src="{{ asset('storage/' . $content->archivo) }}" type="video/mp4">
                            Tu navegador no soporta la etiqueta de video.
                        </video>
                    </div>
                @elseif($content->tipo == 'audio')
                    <div class="mb-3">
                        <audio class="w-100" controls>
                            <source src="{{ asset('storage/' . $content->archivo) }}" type="audio/mpeg">
                            Tu navegador no soporta la etiqueta de audio.
                        </audio>
                    </div>
                @else
                    <div class="mb-3">
                        <iframe src="{{ asset('storage/' . $content->archivo) }}" width="100%" height="600px" frameborder="0"></iframe>
                    </div>
                @endif

                @if(Auth::check() && Auth::user()->role == 'teacher' && Auth::id() == $course->user_id)
                    <div class="d-flex justify-content-between mt-3">
                        <a href="{{ route('contents.edit', $content->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form action="{{ route('contents.destroy', $content->id) }}" method="POST" class="d-inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
