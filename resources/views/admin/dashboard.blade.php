@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <!-- Título del Dashboard -->
    <h1 class="text-6xl font-extrabold text-center text-green-500 mb-12">Dashboard del Administrador</h1>
    <br>

    <!-- Grid centrado -->
    <div class="flex justify-center">
        <!-- Grid para las opciones de gestión -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 max-w-6xl">
            <!-- Opción para gestionar categorías -->
            <div class="bg-white shadow-md rounded-lg p-6 text-center transform hover:scale-105 transition-transform duration-300">
                <h2 class="text-2xl font-bold text-gray-700 mb-4">Gestionar Categorías</h2>
                <p class="text-gray-600 mb-6">Crear, editar y eliminar categorías para los productos.</p>
                <a href="{{ route('admin.categorias.index') }}" class="block bg-blue-600 text-white font-semibold px-5 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-300">
                    Gestionar Categorías
                </a>
            </div>

            <!-- Opción para gestionar medidas -->
            <div class="bg-white shadow-md hover:shadow-lg rounded-lg p-6 text-center transform hover:scale-105 transition-transform duration-300">
                <h2 class="text-2xl font-bold text-gray-700 mb-4">Gestionar Medidas</h2>
                <p class="text-gray-600 mb-6">Crear, editar y eliminar medidas para los productos.</p>
                <a href="{{ route('admin.medidas.index') }}" class="block bg-yellow-500 text-white font-semibold px-5 py-3 rounded-lg hover:bg-yellow-600 transition-colors duration-300">
                    Gestionar Medidas
                </a>
            </div>
        </div>
    </div>
</div>

<br>
<br>
@endsection
