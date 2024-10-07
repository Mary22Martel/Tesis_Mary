@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-12 max-w-3xl">
    <h1 class="text-5xl font-extrabold text-center text-green-500 mb-10">Añadir Nuevo Producto</h1>

    <!-- Mostrar mensajes de error si hay validación fallida -->
    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-6" role="alert">
            <strong class="font-bold">¡Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario para añadir un nuevo producto -->
    <form action="{{ route('productos.store') }}" method="POST" class="bg-white shadow-xl rounded-lg p-10 space-y-8" enctype="multipart/form-data">
        @csrf

        <!-- Nombre del Producto -->
        <div>
            <label for="nombre" class="block text-lg font-semibold text-gray-700 mb-2">Nombre del Producto</label>
            <input type="text" name="nombre" id="nombre" placeholder="Nombre del Producto" value="{{ old('nombre') }}" class="block w-full p-4 border border-gray-300 rounded-lg focus:ring-green-400 focus:border-green-400" required>
        </div>

        <!-- Unidad de medida -->
        <div>
            <label for="medida" class="block text-lg font-semibold text-gray-700 mb-2">Unidad de medida</label>
            <input type="text" name="medida" id="medida" placeholder="Atado, Kilo, unidad, botella" value="{{ old('medida') }}" class="block w-full p-4 border border-gray-300 rounded-lg focus:ring-green-400 focus:border-green-400" required>
        </div>

        <!-- Precio y Cantidad (Grid en una sola fila) -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Precio -->
            <div>
                <label for="precio" class="block text-lg font-semibold text-gray-700 mb-2">Precio</label>
                <input type="number" name="precio" id="precio" placeholder="Ej. 25.99" value="{{ old('precio') }}" step="0.01" class="block w-full p-4 border border-gray-300 rounded-lg focus:ring-green-400 focus:border-green-400" required>
            </div>

            <!-- Cantidad Disponible -->
            <div>
                <label for="cantidad_disponible" class="block text-lg font-semibold text-gray-700 mb-2">Cantidad Disponible</label>
                <input type="number" name="cantidad_disponible" id="cantidad_disponible" placeholder="Ej. 100" value="{{ old('cantidad_disponible') }}" class="block w-full p-4 border border-gray-300 rounded-lg focus:ring-green-400 focus:border-green-400" required>
            </div>
        </div>

        <!-- Categoría -->
        <div>
            <label for="categoria" class="block text-lg font-semibold text-gray-700 mb-2">Categoría</label>
            <input type="text" name="categoria" id="categoria" placeholder="Categoría del Producto" value="{{ old('categoria') }}" class="block w-full p-4 border border-gray-300 rounded-lg focus:ring-green-400 focus:border-green-400" required>
        </div>

        <!-- Descripción -->
        <div>
            <label for="descripcion" class="block text-lg font-semibold text-gray-700 mb-2">Descripción</label>
            <textarea name="descripcion" id="descripcion" rows="4" placeholder="Descripción detallada del producto..." class="block w-full p-4 border border-gray-300 rounded-lg focus:ring-green-400 focus:border-green-400" required>{{ old('descripcion') }}</textarea>
        </div>

        <!-- Imagen del Producto -->
        <div>
            <label for="imagen" class="block text-lg font-semibold text-gray-700 mb-2">Imagen del Producto (JPG, PNG)</label>
            <input type="file" name="imagen" id="imagen" class="block w-full p-4 border border-gray-300 rounded-lg focus:ring-green-400 focus:border-green-400" required>
        </div>

        <!-- Botón de Guardar -->
        <div class="pt-6">
            <button type="submit" class="w-full py-4 bg-green-500 text-white text-lg font-bold rounded-lg hover:bg-green-600 transition duration-300 ease-in-out focus:outline-none focus:ring-4 focus:ring-green-300 focus:ring-opacity-50">
                Guardar Producto
            </button>
        </div>
    </form>
    <br>
    <br>
</div>
@endsection
