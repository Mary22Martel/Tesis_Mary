@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 2.5rem;" class="my-4 text-center">Editar contenido del curso: {{ $course->titulo }}</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h2 style="font-family: 'Times New Roman', Times, serif; font-size: 2rem;">Editar contenido</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('contents.update', $content->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="titulo">Título del Contenido</label>
                            <input type="text" name="titulo" class="form-control" value="{{ $content->titulo }}" placeholder="Introduce el título del contenido" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción del Contenido</label>
                            <textarea name="descripcion" class="form-control" rows="5" placeholder="Describe el contenido" required>{{ $content->descripcion }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo de Contenido</label>
                            <select name="tipo" class="form-control" required>
                                <option value="video" {{ $content->tipo == 'video' ? 'selected' : '' }}>Video</option>
                                <option value="document" {{ $content->tipo == 'document' ? 'selected' : '' }}>Documento</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="archivo">Archivo del Contenido</label>
                            <div class="custom-file">
                                <input type="file" name="archivo" class="custom-file-input" id="archivo">
                                <label class="custom-file-label" for="archivo">Elige el archivo</label>
                            </div>
                            @if($content->archivo)
                                <small class="form-text text-muted mt-2">Archivo actual: <a href="{{ asset('storage/' . $content->archivo) }}" target="_blank">Ver archivo</a></small>
                            @endif
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Actualizar Contenido</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function () {
    bsCustomFileInput.init();
});
</script>
