@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white text-center">
                    <h2 style="font-family: 'Times New Roman', Times, serif; font-size: 2rem;">Crear nuevo curso</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="titulo">Título del Curso</label>
                            <input type="text" name="titulo" class="form-control" placeholder="Introduce el título del curso" required>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Descripción del Curso</label>
                            <textarea name="descripcion" class="form-control" rows="5" placeholder="Describe el curso" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="duracion">Duración (horas)</label>
                            <input type="number" name="duracion" class="form-control" placeholder="Duración del curso en horas" required>
                        </div>
                        <div class="form-group">
                            <label for="precio">Precio</label>
                            <input type="number" step="0.01" name="precio" class="form-control" placeholder="Precio del curso" required>
                        </div>
                        <div class="form-group">
                            <label for="imagen">Imagen del Curso</label>
                            <div class="custom-file">
                                <input type="file" name="imagen" class="custom-file-input" id="imagen">
                                <label class="custom-file-label" for="imagen">Elige la imagen</label>
                            </div>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Crear Curso</button>
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
