<header class="bg-white shadow-sm ">
    <nav class="container mx-auto flex items-center justify-between py-4">
        <!-- Logo alineado a la izquierda -->
        <a href="{{ url('/') }}" class="flex items-center px-20">
            <img src="{{ asset('images/Logo.png') }}"  alt="Ecobazar Logo" class="w-52 ">
        </a>
        <!-- Links de navegación centrados -->
        <ul class="flex space-x-40 text-gray-500">
            <li>
                <a href="#" class="{{ request()->is('nosotros') ? 'text-green-500 font-bold' : 'text-gray-500' }}">Nosotros</a>
            </li>
            <li>
                <a href="#" class="{{ request()->is('tienda') ? 'text-green-500 font-bold' : 'text-gray-500' }}">Tienda</a>
            </li>
            <li>
                <a href="#" class="{{ request()->is('canastas') ? 'text-green-500 font-bold' : 'text-gray-500' }}">Canastas</a>
            </li>
            <li>
                <a href="#" class="{{ request()->is('login') ? 'text-green-500 font-bold' : 'text-gray-500' }}">Iniciar Sesión</a>
            </li>
        </ul>

        <!-- Icono del carrito alineado a la derecha -->
        <div class="relative flex items-center text-gray-500 px-20">
            <a href="#" class="flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-green-600">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18l-1.68 9.74a2 2 0 01-1.99 1.76H6.67a2 2 0 01-1.99-1.76L3 3z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 21a2 2 0 100-4 2 2 0 000 4zm-8 0a2 2 0 100-4 2 2 0 000 4z" />
                </svg>
                <span class="text-black font-bold">$57.00</span>
            </a>
        </div>
    </nav>
</header>
