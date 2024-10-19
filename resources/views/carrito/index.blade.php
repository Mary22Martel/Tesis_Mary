@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-3xl font-bold mb-6">Tu Carrito</h2>

    @if($carrito && $carrito->items->count())
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Tabla de productos del carrito -->
        <div class="col-span-2 bg-white p-6 shadow-md rounded-lg">
            <table class="w-full">
                <thead>
                    <tr class="border-b">
                        <th class="py-4 text-left">Producto</th>
                        <th class="py-4 text-left">Cantidad</th>
                        <th class="py-4 text-left">Precio</th>
                        <th class="py-4 text-left">Total</th>
                        <th class="py-4 text-left">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carrito->items as $item)
                    <tr class="border-b">
                        <!-- Imagen del producto y detalles -->
                        <td class="py-4 flex items-center space-x-4">
                            <img src="{{ asset('storage/' . $item->product->imagen) }}" alt="{{ $item->product->nombre }}" class="w-16 h-16 object-cover rounded">
                            <div>
                                <p class="font-semibold">{{ $item->product->nombre }}</p>
                                <p class="text-sm text-gray-500">Cantidad disponible: {{ $item->product->cantidad_disponible }}</p>
                            </div>
                        </td>
                        
                        <!-- Modificar cantidad -->
                        <td class="py-4">
                            <form action="{{ route('carrito.update', $item->id) }}" method="POST" class="flex items-center">
                                @csrf
                                <div class="flex items-center space-x-2">
                                    <button type="button" class="text-gray-600" onclick="this.parentNode.querySelector('input[type=number]').stepDown()">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="number" name="cantidad" value="{{ $item->cantidad }}" min="1" class="w-12 border rounded px-2 py-1 text-center">
                                    <button type="button" class="text-gray-600" onclick="this.parentNode.querySelector('input[type=number]').stepUp()">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                                <button type="submit" class="ml-4 bg-blue-500 text-white px-3 py-1 rounded">Actualizar</button>
                            </form>
                        </td>

                        <!-- Precio unitario -->
                        <td class="py-4">S/{{ number_format($item->product->precio, 2) }}</td>

                        <!-- Total por producto -->
                        <td class="py-4">S/{{ number_format($item->product->precio * $item->cantidad, 2) }}</td>

                        <!-- Botón para eliminar -->
                        <td class="py-4">
                            <form action="{{ route('carrito.remove', $item->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="text-red-500 hover:underline">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Resumen del carrito -->
        <div class="bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-xl font-bold mb-4">Cart Total</h3>
            
            <!-- Aplicar cupón -->
            <div class="mb-4">
                <input type="text" class="w-full border rounded px-4 py-2" placeholder="Enter Coupon Code">
                <button class="mt-2 bg-green-500 text-white px-4 py-2 rounded w-full">Apply</button>
            </div>

            <!-- Subtotal -->
            <div class="flex justify-between border-t pt-4">
                <span>Subtotal:</span>
                <span>S/{{ number_format($carrito->total(), 2) }}</span>
            </div>

            <!-- Descuento del cupón -->
            <div class="flex justify-between mt-2">
                <span>Coupon Discount:</span>
                <span>(-) S/0.00</span>
            </div>

            <!-- Envío -->
            <div class="flex justify-between mt-2">
                <span>Shipping:</span>
                <span>S/6.90</span>
            </div>

            <!-- Total -->
            <div class="flex justify-between border-t pt-4 mt-4 font-bold text-xl">
                <span>Total (S/):</span>
                <span>S/{{ number_format($carrito->total() + 6.90, 2) }}</span>
            </div>

            <!-- Botón de Checkout -->
            <button class="mt-6 bg-red-500 text-white w-full px-4 py-2 rounded">Process To Checkout</button>

            <!-- Continuar comprando -->
            <a href="{{ route('tienda') }}" class="mt-4 text-center block text-green-500 hover:underline">Return To Shopping</a>
        </div>
    </div>
    @else
        <p>No hay productos en tu carrito.</p>
        <a href="{{ route('tienda') }}" class="bg-green-500 text-white px-4 py-2 rounded">Volver a la tienda</a>
    @endif
</div>
@endsection
