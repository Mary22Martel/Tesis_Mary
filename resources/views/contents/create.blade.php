@extends('layouts.app')

@section('content')
<div class="container">
    <h1 style="font-family: 'Times New Roman', Times, serif; font-size: 2.5rem;" class="my-4 text-center">Añadir contenido al curso: {{ $course->titulo }}</h1>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h2 style="font-family: 'Times New Roman', Times, serif; font-size: 2rem;">Nuevo contenido</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.contents.store', $course->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="titulo">Título del contenido</label>
                            <input type="text" name="titulo" class="form-control" placeholder="Introduce el título del contenido" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción del contenido</label>
                            <textarea name="descripcion" class="form-control" rows="5" placeholder="Describe el contenido" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="tipo">Tipo de contenido</label>
                            <select name="tipo" class="form-control" required>
                                <option value="video">Video</option>
                                <option value="document">Documento</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="archivo">Archivo del contenido</label>
                            <div class="custom-file">
                                <input type="file" name="archivo" class="custom-file-input" id="archivo" required>
                                <label class="custom-file-label" for="archivo">Elige el archivo</label>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Añadir contenido</button>
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
