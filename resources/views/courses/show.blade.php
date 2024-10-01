@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 2.5rem;" class="my-4 text-center">{{ $course->titulo }}</h1>
    <p class="text-center">{{ $course->descripcion }}</p>
   
    <hr>

    @if(Auth::check() && Auth::user()->role == 'teacher' && Auth::id() == $course->user_id)
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('courses.contents.create', $course->id) }}" class="btn btn-primary">Añadir Contenido</a>
        </div>
    @endif

    <h2 class="text-center my-4">Contenido del Curso</h2>
    <div class="row">
        @foreach($course->contents as $content)
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <h4 class="card-title">{{ $content->titulo }}</h4>
                        <p class="card-text">{{ $content->descripcion }}</p>
                        @if($content->tipo == 'video' && $content->archivo)
                            <div class="embed-responsive embed-responsive-16by9 mb-3">
                                <video class="embed-responsive-item" controls>
                                    <source src="{{ asset('storage/' . $content->archivo) }}" type="video/mp4">
                                    Tu navegador no soporta la etiqueta de video.
                                </video>
                            </div>
                        @elseif($content->tipo == 'document' && $content->archivo)
                            <a href="{{ asset('storage/' . $content->archivo) }}" class="btn btn-secondary btn-block" target="_blank">Ver Archivo</a>
                        @endif

                        @if(Auth::check() && Auth::user()->role == 'teacher' && Auth::id() == $course->user_id)
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('contents.edit', $content->id) }}" class="btn btn-warning">Editar</a>
                                <form action="{{ route('contents.destroy', $content->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @if(Auth::check() && Auth::user()->role == 'student' && !$hasPurchased)
        <div class="text-center my-4">
            <a href="{{ route('courses.purchase', $course->id) }}" class="btn btn-primary btn-lg">Comprar Curso</a>
        </div>
    @endif
</div>

@if(session('info'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: "¡Atención!",
            text: "{{ session('info') }}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Sí, porfavor",
            cancelButtonText: "No, gracias",
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('courses.purchase', ['course' => $course->id, 'confirm' => 1]) }}";
            }
        });
    </script>
@endif

@if(session('success'))
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        Swal.fire({
            title: "¡Compra realizada con éxito!",
            width: 600,
            padding: "3em",
            color: "#716add",
            background: "#fff url(https://sweetalert2.github.io/images/trees.png)",
            backdrop: `
                rgba(0,0,123,0.4)
                url("https://sweetalert2.github.io/images/nyan-cat.gif")
                left top
                no-repeat
            `,
            confirmButtonText: 'Ir a Mis cursos'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "{{ route('courses.show', $course->id) }}";
            }
        });
    </script>
@endif
@endsection
