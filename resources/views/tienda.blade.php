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

         <!-- Filtro por Precio -->
    <div class="mt-8">
        <h2 class="text-xl font-bold mb-4">Filtrar por precio</h2>
        <form action="{{ route('productos.filtrarPorPrecio') }}" method="GET">
            <div class="flex justify-between">
                <span>1</span>
                <span>1500</span>
            </div>
            <input type="range" name="min_price" min="1" max="1500" value="{{ request()->get('min_price', 1) }}" class="w-full">
            <input type="range" name="max_price" min="50" max="1500" value="{{ request()->get('max_price', 1500) }}" class="w-full">
            <button type="submit" class="mt-4 bg-green-500 text-white px-4 py-2 rounded-lg w-full hover:bg-green-600">Filtrar</button>
        </form>
    </div>

    <div class="mt-8">
    <h2 class="text-xl font-bold mb-4">Productores</h2>
    <ul class="space-y-2">
        @foreach($productores as $productor)
            <li>
                <a href="{{ route('productos.filtrarPorProductor', $productor->id) }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-lg transition-colors duration-200">
                    <span class="ml-3">{{ $productor->name }}</span>
                </a>
            </li>
        @endforeach
    </ul>
</div>

    </div>

   

    <!-- Productos -->
    <div class="w-3/4 p-4">
        <div class="relative w-full">
            <input type="text" id="search" name="query" placeholder="Buscar productos..." class="border rounded-lg p-2 w-1/2">
            <div id="search-results" class="absolute w-1/2 bg-white shadow-lg z-50 mt-1 rounded-lg hidden">
                <!-- Los resultados de búsqueda se agregarán dinámicamente aquí -->
            </div>
        </div>

        <!-- Mostrar los productos dinámicamente -->
        <div class="grid grid-cols-4 gap-6 mt-4">
            @if($productos->isEmpty())
                <p>No hay productos disponibles en este momento.</p>
            @else
                @foreach ($productos as $producto)
                <div class="block bg-white shadow-lg rounded-lg p-4 transition hover:shadow-xl">
                    @if($producto->imagen)
                        <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}" class="mb-4 w-full h-48 object-cover rounded-lg">
                    @else
                        <div class="mb-4 w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center text-gray-500">
                            Sin imagen
                        </div>
                    @endif

                    <h3 class="font-bold text-lg">{{ $producto->nombre }}</h3>
                    <p class="text-gray-500">S/{{ number_format($producto->precio, 2) }}</p>
                    <p class="text-sm text-gray-400">Disponibles: {{ $producto->cantidad_disponible }}</p>

                    <!-- Formulario para agregar al carrito -->
                    <form class="add-to-cart-form mt-2" action="{{ route('carrito.add', $producto->id) }}" method="POST">
                        @csrf
                        <input type="hidden" name="cantidad" value="1">
                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg w-full hover:bg-green-600">
                            Agregar al carrito
                        </button>
                    </form>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</div>

<!-- Botón de ver carrito (puede estar en la cabecera o en el sidebar) -->
<div class="fixed bottom-4 right-4">
    <a href="{{ route('carrito.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-600">
        Ver carrito
    </a>
</div>
@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Evita el doble binding
    $('.add-to-cart-form').off('submit').on('submit', function(e) {
        e.preventDefault();  // Prevenir la recarga de la página

        let form = $(this);  // Formulario específico que se envió
        let actionUrl = form.attr('action');  // URL del formulario

        $.ajax({
            type: 'POST',
            url: actionUrl,
            data: form.serialize(),  // Enviar los datos del formulario
            success: function(response) {
                if (response.totalItems !== undefined && response.totalPrice !== undefined) {
                    // Actualizar el ícono del carrito con los nuevos valores
                    $('#cart-total-items').text(response.totalItems);  // Número de productos en el carrito
                    $('#cart-total-price').text(response.totalPrice.toFixed(2));  // Precio total

                    // Limpiar el contenido anterior del modal del carrito
                    $('#cart-items-list').empty();

                    // Recorrer los productos agregados y mostrarlos en el modal
                    response.items.forEach(function(item) {
                        $('#cart-items-list').append(`
                            <div class="flex justify-between items-center mb-2">
                                <span>${item.nombre}</span>
                                <span>${item.cantidad}</span>
                                <span>S/${item.subtotal.toFixed(2)}</span>
                            </div>
                        `);
                    });

                    // Actualizar el total en el modal del carrito
                    $('#cart-popup-total-price').text(response.totalPrice.toFixed(2));

                    // Mostrar el mensaje de éxito con SweetAlert
                    Swal.fire({
                        title: 'Producto añadido al carrito!',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Mostrar el modal del carrito
                    $('#cart-summary').removeClass('hidden');
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'No se pudo agregar el producto. Intenta nuevamente.',
                        icon: 'error',
                        showConfirmButton: true,
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Hubo un problema al agregar el producto.',
                    icon: 'error',
                    showConfirmButton: true,
                });
            }
        });
    });
});


</script>
@endsection
