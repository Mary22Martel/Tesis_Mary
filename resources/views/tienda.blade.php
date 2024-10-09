@extends('layouts.app')

@section('content')
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/5 bg-white shadow-lg p-4">
            <!-- Aquí tus filtros de categorías, precio, etc. -->
            <h2 class="text-xl font-bold mb-4">Categorías</h2>
            <ul class="space-y-2">
                <li>
                    <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-lg">
                        <span class="ml-3">Todo</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg">
                        <span class="ml-3">Vegetales</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-lg">
                        <span class="ml-3">Frutas</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-lg">
                        <span class="ml-3">Pescado</span>
                    </a>
                </li>
            </ul>

            <!-- Filtros de Precio -->
            <div class="mt-6">
                <h3 class="text-lg font-bold">Precio</h3>
                <input type="range" min="50" max="1500" class="w-full mt-2">
                <p>Precio: $50 - $1500</p>
            </div>

            <!-- Tags Populares -->
            <div class="mt-6">
                <h3 class="text-lg font-bold">Tags Populares</h3>
                <div class="flex flex-wrap gap-2 mt-2">
                    <span class="px-2 py-1 bg-gray-200 rounded-lg">Saludable</span>
                    <span class="px-2 py-1 bg-gray-200 rounded-lg">Vegetariano</span>
                    <span class="px-2 py-1 bg-gray-200 rounded-lg">Vitaminas</span>
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="w-3/4 p-4">
            <div class="flex justify-between items-center mb-4">
                <input id="search" type="text" placeholder="Buscar productos..." class="border rounded-lg p-2 w-1/2">
                <button class="bg-green-500 text-white px-4 py-2 rounded-lg ml-2" id="search-btn">Buscar</button>
                <select class="border rounded-lg p-2 ml-4">
                    <option>Ordenar por Categoría</option>
                    <!-- Más opciones de orden -->
                </select>
            </div>

            <!-- Mostrar los productos dinámicamente -->
            <div id="productos-container" class="grid grid-cols-4 gap-6">
                @if ($productos->isEmpty())
                    <p>No hay productos disponibles en este momento.</p>
                @else
                    @foreach ($productos as $producto)
                        <div class="bg-white shadow-lg rounded-lg p-4">
                            @if ($producto->imagen)
                                <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}"
                                    class="mb-4 w-full h-32 object-cover rounded-lg">
                            @endif
                            <h3 class="font-bold">{{ $producto->nombre }}</h3>
                            <p class="text-gray-500">${{ number_format($producto->precio, 2) }}</p>
                            <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 w-full">Agregar al
                                carrito</button>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <script>
        document.getElementById('search').addEventListener('input', function() {
            let query = this.value.trim();

            // Si el campo de búsqueda está vacío, recargar todos los productos
            if (query === '') {
                fetch(`/buscar-productos`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        const productosContainer = document.getElementById('productos-container');
                        productosContainer.innerHTML = ''; // Limpiar productos anteriores

                        if (data.productos && data.productos.length > 0) {
                            data.productos.forEach(producto => {
                                let precio = parseFloat(producto.precio);
                                if (!isNaN(precio)) {
                                    precio = precio.toFixed(2);
                                } else {
                                    precio = 'N/A'; // O muestra un mensaje por defecto
                                }

                                let productoHtml = `
                        <div class="bg-white shadow-lg rounded-lg p-4">
                            ${producto.imagen ? `<img src="/storage/${producto.imagen}" alt="${producto.nombre}" class="mb-4 w-full h-32 object-cover rounded-lg">` : ''}
                            <h3 class="font-bold">${producto.nombre}</h3>
                            <p class="text-gray-500">$${precio}</p>
                            <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 w-full">Agregar al carrito</button>
                        </div>
                    `;
                                productosContainer.innerHTML += productoHtml;
                            });
                        } else {
                            productosContainer.innerHTML =
                                '<p>No hay productos disponibles en este momento.</p>';
                        }
                    })
                    .catch(error => console.error('Error:', error));
                return; // Salir de la función para evitar hacer la búsqueda
            }

            // Si hay texto en el campo de búsqueda, buscar productos relacionados
            fetch(`/buscar-productos?q=${query}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    const productosContainer = document.getElementById('productos-container');
                    productosContainer.innerHTML = ''; // Limpiar productos anteriores

                    if (data.productos && data.productos.length > 0) {
                        data.productos.forEach(producto => {
                            let precio = parseFloat(producto.precio);
                            if (!isNaN(precio)) {
                                precio = precio.toFixed(2);
                            } else {
                                precio = 'N/A'; // O muestra un mensaje por defecto
                            }

                            let productoHtml = `
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        ${producto.imagen ? `<img src="/storage/${producto.imagen}" alt="${producto.nombre}" class="mb-4 w-full h-32 object-cover rounded-lg">` : ''}
                        <h3 class="font-bold">${producto.nombre}</h3>
                        <p class="text-gray-500">$${precio}</p>
                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 w-full">Agregar al carrito</button>
                    </div>
                `;
                            productosContainer.innerHTML += productoHtml;
                        });
                    } else {
                        productosContainer.innerHTML = '<p>No hay productos disponibles en este momento.</p>';
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
