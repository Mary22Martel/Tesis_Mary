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

                    <!-- Carrito de compras -->
                    <a href="#" class="relative flex items-center text-gray-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-green-600">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18l-1.68 9.74a2 2 0 01-1.99 1.76H6.67a2 2 0 01-1.99-1.76L3 3z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21a2 2 0 100-4 2 2 0 000 4zm-8 0a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                        <span class="ml-2 text-black font-bold">$57.00</span>
                    </a>
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
                
                <!-- Categorías de productos -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Categorías</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Frutas y Verduras</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Bebidas</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Lácteos y Huevos</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Cereales y Legumbres</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Productos Orgánicos</a></li>
                    </ul>
                </div>

                <!-- Enlaces útiles -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Enlaces Útiles</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Inicio</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Sobre Nosotros</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Contacto</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Blog</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Términos y Condiciones</a></li>
                    </ul>
                </div>

                <!-- Centro de ayuda -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Centro de Ayuda</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Tu Pedido</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Tu Cuenta</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Rastreo de Pedido</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Lista de Deseos</a></li>
                        <li><a href="#" class="text-gray-500 hover:text-green-500">Preguntas Frecuentes</a></li>
                    </ul>
                </div>

                <!-- Información de Contacto -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Contáctanos</h3>
                    <p class="text-gray-500 mb-2">
                        <i class="fas fa-phone-alt text-green-500"></i> Soporte 24/7: +51 999 999 999
                    </p>
                    <p class="text-gray-500 mb-2">
                        <i class="fas fa-envelope text-green-500"></i> Email: contacto@ecobazar.com
                    </p>
                    <p class="text-gray-500 mb-2">
                        <i class="fas fa-map-marker-alt text-green-500"></i> Dirección: Calle Ejemplo 123, Ciudad, País
                    </p>
                </div>
            </div>

            <!-- Payment and Credits -->
            <div class="mt-8 border-t border-gray-200 pt-6">
                <div class="container mx-auto flex flex-col md:flex-row justify-between items-center text-gray-500">
                    <p class="mb-4 md:mb-0">Ecobazar eCommerce © 2024. Todos los derechos reservados</p>
                    <div class="flex space-x-4">
                        <img src="{{ asset('images/tarjetas.png') }}" alt="Métodos de pago" class="w-22">
                    </div>
                </div>
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
    </script>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</body>
</html>
