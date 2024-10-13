@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <div class="w-1/5 bg-white shadow-lg p-4">
    <h2 class="text-xl font-bold mb-4">Categorías</h2>
    <ul class="space-y-2">
        <!-- Enlace para ver todos los productos -->
        <li>
            <a href="{{ route('tienda') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-lg">
                <span class="ml-3">Todo</span>
            </a>
        </li>

        <!-- Mostrar categorías dinámicamente -->
        @foreach($categorias as $cat)
            <li>
                <a href="{{ route('productos.filtrarPorCategoria', $cat->id) }}" class="flex items-center px-4 py-2 {{ request()->is('productos/categoria/'.$cat->id) ? 'bg-green-500 text-white' : 'text-gray-700 hover:bg-gray-200' }} rounded-lg">
                    <span class="ml-3">{{ $cat->nombre }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>

    <!-- Productos -->
    <div class="w-3/4 p-4">
        <div class="flex justify-between items-center mb-4">
            <form action="{{ route('productos.buscar') }}" method="GET" class="flex w-full">
                <input type="text" name="query" placeholder="Buscar productos..." class="border rounded-lg p-2 w-1/2" value="{{ request('query') }}">
                <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg ml-2">Buscar</button>
            </form>
        </div>
        @if($productos->isEmpty())
    <p>No hay productos disponibles en este momento.</p>
@else
    <!-- Mostrar los productos -->
@endif

        <!-- Mostrar los productos dinámicamente -->
        <div class="grid grid-cols-4 gap-6">
            @if($productos->isEmpty())
                <p>No hay productos disponibles en este momento.</p>
            @else
                @foreach ($productos as $producto)
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <!-- Si tienes una imagen del producto -->
                    @if($producto->imagen)
                        <!-- Usamos w-full para el ancho completo, h-32 para la altura fija, y object-cover para ajustar la imagen -->
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="mb-4 w-full h-48 object-cover rounded-lg">
                    @else
                        <div class="mb-4 w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">
                            Sin imagen
                        </div>
                    @endif

                    <h3 class="font-bold">{{ $producto->nombre }}</h3>
                    <p class="text-gray-500">S/{{ number_format($producto->precio, 2) }}</p>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 w-full">Agregar al carrito</button>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>
@endsection
