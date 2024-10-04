@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-8">
    <h1 class="text-3xl font-bold mb-6">Mis Productos</h1>
    <a href="{{ route('productos.create') }}" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 transition">Crear nuevo producto</a>

    @if(session('success'))
        <div class="mt-4 p-4 bg-green-200 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto mt-6">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-gray-100 text-gray-600">
                    <th class="py-2 px-4 border-b">Imagen</th>
                    <th class="py-2 px-4 border-b">Nombre</th>
                    <th class="py-2 px-4 border-b">Categoría</th>
                    <th class="py-2 px-4 border-b">Precio</th>
                    <th class="py-2 px-4 border-b">Cantidad</th>
                    <th class="py-2 px-4 border-b">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr class="hover:bg-gray-50">
                        <td class="py-2 px-4 border-b">
                            @if($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="w-16 h-16 object-cover">
                            @else
                                <span class="text-gray-500">Sin imagen</span>
                            @endif
                        </td>
                        <td class="py-2 px-4 border-b">{{ $producto->nombre }}</td>
                        <td class="py-2 px-4 border-b">{{ $producto->categoria }}</td>
                        <td class="py-2 px-4 border-b">{{ $producto->precio }}</td>
                        <td class="py-2 px-4 border-b">{{ $producto->cantidad_disponible }}</td>
                        <td class="py-2 px-4 border-b">
                            <a href="{{ route('productos.edit', $producto) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">Editar</a>
                            <form action="{{ route('productos.destroy', $producto) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition" onclick="return confirm('¿Estás seguro de que deseas eliminar este producto?');">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                @if($productos->isEmpty())
                    <tr>
                        <td colspan="6" class="text-center py-4">No tienes productos aún. <a href="{{ route('productos.create') }}" class="text-blue-500 underline">Crea uno aquí</a>.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection
