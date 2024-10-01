@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="w-1/5 bg-white shadow-lg p-4">
            <h2 class="text-xl font-bold mb-4">Categorías</h2>
            <ul class="space-y-2">
                <li>
                    <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-lg">
                        <span class="ml-3">Todo</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-2 bg-green-500 text-white rounded-lg">
                        <span class="ml-3">Vegetables</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-lg">
                        <span class="ml-3">Fruta</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-200 rounded-lg">
                        <span class="ml-3">Pescado</span>
                    </a>
                </li>
                <!-- Más categorías -->
            </ul>

            <!-- Filtros de Precio -->
            <div class="mt-6">
                <h3 class="text-lg font-bold">Price</h3>
                <input type="range" min="50" max="1500" class="w-full mt-2">
                <p>Price: $50 - $1500</p>
            </div>

            <!-- Tags Populares -->
            <div class="mt-6">
                <h3 class="text-lg font-bold">Popular Tags</h3>
                <div class="flex flex-wrap gap-2 mt-2">
                    <span class="px-2 py-1 bg-gray-200 rounded-lg">Healthy</span>
                    <span class="px-2 py-1 bg-gray-200 rounded-lg">Vegetarian</span>
                    <span class="px-2 py-1 bg-gray-200 rounded-lg">Vitamins</span>
                    <!-- Más etiquetas -->
                </div>
            </div>
        </div>

        <!-- Productos -->
        <div class="w-3/4 p-4">
            <div class="flex justify-between items-center mb-4">
                <input type="text" placeholder="Buscar productos..." class="border rounded-lg p-2 w-1/2">
                <button class="bg-green-500 text-white px-4 py-2 rounded-lg ml-2">Buscar</button>
                <select class="border rounded-lg p-2 ml-4">
                    <option>Ordenar por Categoría</option>
                    <!-- Más opciones de orden -->
                </select>
            </div>

            <div class="grid grid-cols-4 gap-6">
                <!-- Producto 1 -->
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <img src="producto1.jpg" alt="Producto 1" class="w-full h-32 object-cover mb-2">
                    <h3 class="font-bold">Red Chili</h3>
                    <p class="text-gray-500">$14.99</p>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 w-full">Agregar al carrito</button>
                </div>

                <!-- Producto 2 -->
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <img src="producto2.jpg" alt="Producto 2" class="w-full h-32 object-cover mb-2">
                    <h3 class="font-bold">Big Potatos</h3>
                    <p class="text-gray-500">$14.99</p>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 w-full">Agregar al carrito</button>
                </div>

                <!-- Más productos -->
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <img src="producto3.jpg" alt="Producto 3" class="w-full h-32 object-cover mb-2">
                    <h3 class="font-bold">Chinese Cabbage</h3>
                    <p class="text-gray-500">$14.99</p>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 w-full">Agregar al carrito</button>
                </div>

                <!-- Producto 4 -->
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <img src="producto4.jpg" alt="Producto 4" class="w-full h-32 object-cover mb-2">
                    <h3 class="font-bold">Ladies Finger</h3>
                    <p class="text-gray-500"><s>$14.99</s> $10.99</p>
                    <span class="bg-red-500 text-white px-2 py-1 text-xs rounded-lg">Sale 30%</span>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 w-full">Agregar al carrito</button>
                </div>

                <!-- Producto 4 -->
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <img src="producto4.jpg" alt="Producto 4" class="w-full h-32 object-cover mb-2">
                    <h3 class="font-bold">Ladies Finger</h3>
                    <p class="text-gray-500"><s>$14.99</s> $10.99</p>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 w-full">Agregar al carrito</button>
                </div>

                <!-- Producto 4 -->
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <img src="producto4.jpg" alt="Producto 4" class="w-full h-32 object-cover mb-2">
                    <h3 class="font-bold">Ladies Finger</h3>
                    <p class="text-gray-500"><s>$14.99</s> $10.99</p>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 w-full">Agregar al carrito</button>
                </div>

                <!-- Producto 4 -->
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <img src="producto4.jpg" alt="Producto 4" class="w-full h-32 object-cover mb-2">
                    <h3 class="font-bold">Ladies Finger</h3>
                    <p class="text-gray-500"><s>$14.99</s> $10.99</p>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 w-full">Agregar al carrito</button>
                </div>

                <!-- Producto 4 -->
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <img src="producto4.jpg" alt="Producto 4" class="w-full h-32 object-cover mb-2">
                    <h3 class="font-bold">Ladies Finger</h3>
                    <p class="text-gray-500"><s>$14.99</s> $10.99</p>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 w-full">Agregar al carrito</button>
                </div>

                <!-- Producto 4 -->
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <img src="producto4.jpg" alt="Producto 4" class="w-full h-32 object-cover mb-2">
                    <h3 class="font-bold">Ladies Finger</h3>
                    <p class="text-gray-500"><s>$14.99</s> $10.99</p>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 w-full">Agregar al carrito</button>
                </div>

                <!-- Producto 4 -->
                <div class="bg-white shadow-lg rounded-lg p-4">
                    <img src="producto4.jpg" alt="Producto 4" class="w-full h-32 object-cover mb-2">
                    <h3 class="font-bold">Ladies Finger</h3>
                    <p class="text-gray-500"><s>$14.99</s> $10.99</p>
                    <button class="bg-green-500 text-white px-4 py-2 rounded-lg mt-2 w-full">Agregar al carrito</button>
                </div>

                <!-- Más productos según el diseño -->
            </div>
        </div>
    </div>
</body>
</html>


@endsection
