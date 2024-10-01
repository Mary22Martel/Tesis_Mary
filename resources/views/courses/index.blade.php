@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4 text-center">Nuestros Cursos</h1>
    
    <!-- Formulario de búsqueda -->
    <form action="{{ route('courses.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Buscar cursos..." value="{{ request()->query('search') }}">
            <div class="input-group-append">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </div>
    </form>

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
                        @guest
                            <a href="{{ route('register') }}" class="btn btn-primary">Comprar</a>
                        @else
                            @if(Auth::user()->role == 'student')
                                <a href="{{ route('courses.purchase', $course->id) }}" class="btn btn-primary">Comprar</a>
                            @endif
                        @endguest
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Paginación -->
    {{ $courses->appends(request()->query())->links() }}
</div>
@endsection
