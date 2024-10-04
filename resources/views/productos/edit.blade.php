@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6">Editar Producto</h1>

    <form action="{{ route('productos.update', $producto) }}" method="POST" class="bg-white shadow-md rounded-lg p-6" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nombre del Producto -->
        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
            <input type="text" name="nombre" id="nombre" value="{{ $producto->nombre }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ $producto->descripcion }}</textarea>
        </div>

        <!-- Precio -->
        <div class="mb-4">
            <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
            <input type="number" name="precio" id="precio" value="{{ $producto->precio }}" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <!-- Cantidad Disponible -->
        <div class="mb-4">
            <label for="cantidad_disponible" class="block text-sm font-medium text-gray-700">Cantidad Disponible</label>
            <input type="number" name="cantidad_disponible" id="cantidad_disponible" value="{{ $producto->cantidad_disponible }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <!-- Categoría -->
        <div class="mb-4">
            <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
            <input type="text" name="categoria" id="categoria" value="{{ $producto->categoria }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <!-- Imagen del Producto -->
        <div class="mb-4">
            <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen del Producto</label>
            <input type="file" name="imagen" id="imagen" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            @if($producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="mt-4 w-32 h-32 object-cover">
            @endif
        </div>

        <!-- Botón de Actualizar -->
        <button type="submit" class="w-full bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Actualizar Producto</button>
    </form>
</div>
@endsection
