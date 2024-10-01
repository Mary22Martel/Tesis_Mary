@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6 text-center">Dashboard del Agricultor</h1>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Card para gestionar productos -->
        <div class="bg-white shadow-lg rounded-lg p-6">
            <h4 class="text-xl font-semibold mb-2">Gestionar Productos</h4>
            <p class="text-gray-600 mb-4">Aquí puedes ver y gestionar todos tus productos.</p>
            <a href="{{ route('productos.index') }}" class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Ver Mis Productos</a>
            <a href="{{ route('productos.create') }}" class="inline-block bg-green-500 text-white px-4 py-2 rounded mt-2 hover:bg-green-600 transition">Agregar Nuevo Producto</a>
        </div>
    </div>
</div>
@endsection