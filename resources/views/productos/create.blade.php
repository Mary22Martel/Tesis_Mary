@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6">Crear Producto</h1>

    <form action="{{ route('productos.store') }}" method="POST" class="bg-white shadow-md rounded-lg p-6" enctype="multipart/form-data">
        @csrf
        
        <!-- Nombre del Producto -->
        <div class="mb-4">
            <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Producto</label>
            <input type="text" name="nombre" id="nombre" value="{{ old('nombre') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <!-- Descripción -->
        <div class="mb-4">
            <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
            <textarea name="descripcion" id="descripcion" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">{{ old('descripcion') }}</textarea>
        </div>

        <!-- Precio -->
        <div class="mb-4">
            <label for="precio" class="block text-sm font-medium text-gray-700">Precio</label>
            <input type="number" name="precio" id="precio" value="{{ old('precio') }}" step="0.01" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <!-- Cantidad Disponible -->
        <div class="mb-4">
            <label for="cantidad_disponible" class="block text-sm font-medium text-gray-700">Cantidad Disponible</label>
            <input type="number" name="cantidad_disponible" id="cantidad_disponible" value="{{ old('cantidad_disponible') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <!-- Categoría -->
        <div class="mb-4">
            <label for="categoria" class="block text-sm font-medium text-gray-700">Categoría</label>
            <input type="text" name="categoria" id="categoria" value="{{ old('categoria') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        <!-- Imagen del Producto -->
        <div class="mb-4">
            <label for="imagen" class="block text-sm font-medium text-gray-700">Imagen del Producto</label>
            <input type="file" name="imagen" id="imagen" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        </div>

        <!-- Botón de Guardar -->
        <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Guardar Producto</button>
    </form>
</div>
@endsection
