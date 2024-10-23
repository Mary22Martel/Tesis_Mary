@extends('layouts.app')

@section('content')
<div class="container mx-auto py-8">
    <h2 class="text-3xl font-bold mb-6">Información de Compra</h2>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Formulario de Información de Compra -->
        <div class="col-span-2 bg-white p-6 shadow-md rounded-lg">
            <form action="{{ route('order.store') }}" method="POST">
                @csrf
                <!-- Información del Cliente -->
                <h3 class="text-xl font-bold mb-4">Información de Compra</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="text" name="nombre" placeholder="Nombres" class="border rounded px-4 py-2" required>
                    <input type="text" name="apellido" placeholder="Apellidos" class="border rounded px-4 py-2" required>
                    <input type="text" name="empresa" placeholder="Nombre de empresa (opcional)" class="border rounded px-4 py-2">
                    <input type="email" name="email" placeholder="Correo Electronico" class="border rounded px-4 py-2" required>
                    <input type="text" name="telefono" placeholder="Telefono" class="border rounded px-4 py-2" required>
                </div>

                <!-- Opciones de Delivery -->
                <h3 class="text-xl font-bold my-4">Opciones de Delivery</h3>
                <div class="flex space-x-4 mb-4">
                    <label class="flex items-center">
                        <input type="radio" name="delivery" value="puesto" class="mr-2" required> Recoger en Puesto
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="delivery" value="delivery" class="mr-2" required> Delivery
                    </label>
                </div>
                <div id="delivery-fields">
                    <input type="text" name="direccion" placeholder="Nombre de la calle y número de casa" class="border rounded w-full px-4 py-2 mb-2" required>
                    <input type="text" name="direccion_opcional" placeholder="Dpto., piso, unidad, bloque (opcional)" class="border rounded w-full px-4 py-2 mb-2">
                    <input type="text" name="distrito" placeholder="Distrito" class="border rounded w-full px-4 py-2 mb-2" required>
                </div>

                <!-- Opción de Pago -->
                <h3 class="text-xl font-bold my-4">Opción de Pago</h3>
                <div class="flex space-x-4 mb-4">
                    <label class="flex items-center">
                        <input type="radio" name="pago" value="puesto" class="mr-2" required> Pagar en Puesto
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="pago" value="sistema" class="mr-2" required> Pagar en el Sistema
                    </label>
                </div>
                <div id="payment-fields">
                    <input type="text" name="nombre_tarjeta" placeholder="Nombre del Titular" class="border rounded w-full px-4 py-2 mb-2">
                    <input type="text" name="numero_tarjeta" placeholder="Número de la Tarjeta" class="border rounded w-full px-4 py-2 mb-2">
                    <div class="grid grid-cols-2 gap-4">
                        <input type="text" name="fecha_expiracion" placeholder="Fecha de Expiración" class="border rounded px-4 py-2 mb-2">
                        <input type="text" name="cvc" placeholder="CVC" class="border rounded px-4 py-2 mb-2">
                    </div>
                </div>

                <button type="submit" class="w-full bg-green-500 text-white py-3 rounded-lg font-semibold text-lg hover:bg-green-600 transition duration-200">Realizar pedido</button>
            </form>
        </div>

        <!-- Resumen del pedido -->
        <div class="bg-white p-6 shadow-md rounded-lg">
            <h3 class="text-2xl font-bold mb-4">Resumen de tu compra</h3>
            @foreach ($carrito->items as $item)
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center">
                    <div>
                        <p class="font-bold">{{ $item->product->nombre }} x{{ $item->cantidad }}</p>
                        <p class="text-gray-600">S/{{ number_format($item->product->precio * $item->cantidad, 2) }}</p>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="flex justify-between mt-4 border-t pt-4">
                <span>Subtotal:</span>
                <span>S/{{ number_format($carrito->total(), 2) }}</span>
            </div>
            <div class="flex justify-between mt-2">
                <span>Envío:</span>
                <span>S/8.00</span>
            </div>
            <div class="flex justify-between mt-4 border-t pt-4 font-bold text-xl">
                <span>Total:</span>
                <span>S/{{ number_format($carrito->total() + 8.00, 2) }}</span>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mostrar u ocultar campos de dirección según la opción de delivery
        const deliveryOptions = document.querySelectorAll('input[name="delivery"]');
        const deliveryFields = document.getElementById('delivery-fields');

        deliveryOptions.forEach(option => {
            option.addEventListener('change', function() {
                if (this.value === 'delivery') {
                    deliveryFields.style.display = 'block';
                    deliveryFields.querySelectorAll('input').forEach(field => field.removeAttribute('disabled'));
                } else {
                    deliveryFields.style.display = 'none';
                    deliveryFields.querySelectorAll('input').forEach(field => field.setAttribute('disabled', 'disabled'));
                }
            });
        });

        // Inicialmente ocultar los campos de dirección si no se selecciona "delivery"
        deliveryFields.style.display = 'none';
        deliveryFields.querySelectorAll('input').forEach(field => field.setAttribute('disabled', 'disabled'));

        // Mostrar u ocultar campos de tarjeta según la opción de pago
        const paymentOptions = document.querySelectorAll('input[name="pago"]');
        const paymentFields = document.getElementById('payment-fields');

        paymentOptions.forEach(option => {
            option.addEventListener('change', function() {
                if (this.value === 'sistema') {
                    paymentFields.style.display = 'block';
                    paymentFields.querySelectorAll('input').forEach(field => field.removeAttribute('disabled'));
                } else {
                    paymentFields.style.display = 'none';
                    paymentFields.querySelectorAll('input').forEach(field => field.setAttribute('disabled', 'disabled'));
                }
            });
        });

        // Inicialmente ocultar los campos de tarjeta si no se selecciona "sistema"
        paymentFields.style.display = 'none';
        paymentFields.querySelectorAll('input').forEach(field => field.setAttribute('disabled', 'disabled'));
    });
</script>
@endsection
