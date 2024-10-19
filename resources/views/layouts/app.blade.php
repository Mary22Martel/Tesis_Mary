<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Tailwind CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.5/dist/tailwind.min.css" rel="stylesheet">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
     <!-- Incluye jQuery y SweetAlert2 al inicio, antes de tus scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    
    @vite('resources/css/app.css')
</head>
  
<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="bg-white shadow-md py-4">
            <div class="container mx-auto flex justify-between items-center px-20">
                <!-- Logo -->
                <a href="{{ url('/') }}" class="flex items-center">
                    <img src="{{ asset('images/Logo.png') }}" alt="Ecobazar Logo" class="w-52">
                </a>
                
                <!-- Links de navegación -->
                <ul class="flex space-x-8 text-gray-500">
                    <li>
                        <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'text-green-500 font-bold' : 'text-gray-500' }}">Home</a>
                    </li>
                    <li>
                        <a href="#" class="{{ request()->is('nosotros') ? 'text-green-500 font-bold' : 'text-gray-500' }}">Nosotros</a>
                    </li>
                    <li>
                        <a href="{{ route('tienda') }}" class="{{ request()->is('tienda') ? 'text-green-500 font-bold' : 'text-gray-500' }}">Tienda</a>
                    </li>
                    <li>
                        <a href="#" class="{{ request()->is('canastas') ? 'text-green-500 font-bold' : 'text-gray-500' }}">Canastas</a>
                    </li>
                    @auth
                        @if(Auth::user()->role == 'repartidor')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('repartidor.dashboard') }}">{{ __('Repartidor Dashboard') }}</a>
                            </li>
                        @elseif(Auth::user()->role == 'agricultor')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('agricultor.dashboard') }}">{{ __('Agricultor Dashboard ') }}</a>
                            </li>
                        @elseif(Auth::user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">{{ __('Admin Dashboard') }}</a>
                            </li>
                        @elseif(Auth::user()->role == 'cliente')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('cliente.dashboard') }}">{{ __('Cliente Dashboard') }}</a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <!-- Right Side Navbar -->
                <div class="flex items-center space-x-6">
                    @guest
                        <a href="{{ route('login') }}" class="text-gray-500 {{ request()->is('login') ? 'text-green-500 font-bold' : '' }}">Iniciar Sesión</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="text-gray-500 {{ request()->is('register') ? 'text-green-500 font-bold' : '' }}">Registrarse</a>
                        @endif
                    @else
                        <div class="relative">
                            <button id="userMenuButton" class="text-gray-500 flex items-center focus:outline-none" onclick="toggleDropdown('userMenu')">
                                {{ Auth::user()->name }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <!-- Dropdown Menu -->
                            <div id="userMenu" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg z-10">
                                <a href="{{ route('logout') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Cerrar Sesión
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest

                    @php
    use Illuminate\Support\Facades\Auth;
    use App\Models\Carrito;

    $carrito = null;
    $totalItems = 0;
    $totalPrice = 0.00;

    if (Auth::check()) {
        $carrito = Carrito::where('user_id', Auth::id())->with('items.product')->first();
        if ($carrito) {
            $totalItems = $carrito->items->sum('cantidad');
            $totalPrice = $carrito->items->sum(function ($item) {
                return $item->product->precio * $item->cantidad;
            });
        }
    }
@endphp


                    <!-- Botón de carrito -->
<a href="#" class="relative flex items-center text-gray-500" id="cart-button">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-green-600">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18l-1.68 9.74a2 2 0 01-1.99 1.76H6.67a2 2 0 01-1.99-1.76L3 3z" />
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21a2 2 0 100-4 2 2 0 000 4zm-8 0a2 2 0 100-4 2 2 0 000 4z" />
    </svg>
    <span id="cart-total-items" class="ml-2 text-black font-bold">{{ $totalItems }}</span>
<span class="ml-2 text-black font-bold">S/<span id="cart-total-price">{{ number_format($totalPrice, 2) }}</span></span>

</a>

<!-- Modal del carrito -->
<div id="cart-summary" class="absolute hidden right-0 mt-2 w-72 bg-white shadow-lg rounded-lg z-50">
    <div class="p-4">
        <div id="cart-items-list">
            <!-- Los productos agregados al carrito se agregarán aquí dinámicamente -->
        </div>
        <div class="border-t pt-2">
            <span>Total: S/<span id="cart-popup-total-price">0.00</span></span>
        </div>
        <div class="mt-4 text-right">
            <a href="{{ route('carrito.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">
                Ver carrito
            </a>
        </div>
    </div>
</div>

                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-0">
            @if (session('success'))
                <div class="container mx-auto">
                    <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4" role="alert">
                        {{ session('success') }}
                    </div>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-100 text-gray-700 py-12 px-20">
            <div class="container mx-auto grid grid-cols-1 md:grid-cols-5 gap-8">
                <!-- Logo y Descripción -->
                <div>
                    <a href="#" class="flex items-center space-x-2 mb-4">
                        <img src="{{ asset('images/Logo.png') }}" alt="Ecobazar Logo" class="w-34">
                    </a>
                    <p class="text-gray-500">
                        Somos tu mercado en línea para productos frescos y de calidad provenientes de ferias agrícolas locales. ¡Compra directamente de los agricultores!
                    </p>
                    <div class="flex space-x-4 mt-4">
                        <a href="#" class="text-2xl text-gray-700 hover:text-green-500 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-2xl text-gray-700 hover:text-green-500 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-2xl text-gray-700 hover:text-green-500 transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>

                <!-- Más contenido del footer -->

            </div>
        </footer>
    </div>

    <!-- Toggle Dropdown Script -->
    <script>
        function toggleDropdown(menuId) {
            const menu = document.getElementById(menuId);
            menu.classList.toggle('hidden');
        }

        document.addEventListener('click', function(event) {
            const userMenuButton = document.getElementById('userMenuButton');
            const userMenu = document.getElementById('userMenu');
            if (!userMenuButton.contains(event.target)) {
                userMenu.classList.add('hidden');
            }
        });

        // Mostrar/Ocultar el resumen del carrito
        document.getElementById('cart-button').addEventListener('click', function(event) {
            event.preventDefault();  // Prevenir el comportamiento por defecto
            const cartSummary = document.getElementById('cart-summary');
            cartSummary.classList.toggle('hidden');  // Mostrar/ocultar el resumen del carrito
        });


        // Ocultar el dropdown si se hace clic fuera
        document.addEventListener('click', function(event) {
            const cartButton = document.getElementById('cart-button');
            const cartSummary = document.getElementById('cart-summary');
            if (!cartButton.contains(event.target) && !cartSummary.contains(event.target)) {
                cartSummary.classList.add('hidden');
            }
        });
    </script>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <!-- Script para manejar el AJAX de agregar al carrito -->
    <!-- Script para manejar el AJAX de agregar al carrito -->
<script>
$(document).ready(function() {
    $('.add-to-cart-form').on('submit', function(e) {
        e.preventDefault();

        let form = $(this);
        let actionUrl = form.attr('action');

        $.ajax({
            type: 'POST',
            url: actionUrl,
            data: form.serialize(),
            success: function(response) {
                // Actualizar el ícono del carrito con los nuevos valores
                $('#cart-total-items').text(response.totalItems);
                $('#cart-total-price').text(response.totalPrice.toFixed(2));

                // Actualizar el contenido del carrito en el modal
                // Limpia el listado antes de volver a agregar los items
                $('#cart-items-list').empty();
                response.carritoItems.forEach(function(item) {
                    $('#cart-items-list').append(`
                        <div class="flex justify-between items-center mb-2">
                            <span>${item.nombre}</span>
                            <span>${item.cantidad}</span>
                            <span>S/${(item.precio * item.cantidad).toFixed(2)}</span>
                        </div>
                    `);
                });

                // Actualizar el total en el popup del carrito
                $('#cart-popup-total-price').text(response.totalPrice.toFixed(2));

                // Mostrar un mensaje de éxito usando SweetAlert2
                Swal.fire({
                    title: 'Producto añadido al carrito!',
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 1500
                });
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

    @yield('scripts')
</body>
</html>
