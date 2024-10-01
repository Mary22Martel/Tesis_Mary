@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative h-screen mt-0">
        <!-- Imagen de fondo dentro de un div -->
        <div class="absolute inset-0">
            <img src="{{ asset('images/Image.png') }}" alt="Background Image" class="w-full h-full object-cover">
        </div>
        <!-- Overlay (superposición) con menos opacidad -->
        <div class="absolute inset-0 bg-green-900 bg-opacity-20"></div> 

        <!-- Contenido -->
        <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4">
            <h1 class="text-white text-5xl md:text-7xl font-bold mb-4">Una parte vital de la Comunidad</h1>
            <br>
            <br>
            <p class="text-white text-lg md:text-3xl mb-8">Compre en nuestro mercado de agricultores en <br> línea comida local de calidad.</p>
            <br>
            <div class="flex space-x-8 justify-center">
                <a href="#" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-full inline-flex items-center space-x-2">
                    Mirar Video
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-8 h-8">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-5.197-3.482A1 1 0 008 8.481v7.038a1 1 0 001.555.832l5.197-3.482a1 1 0 000-1.664z" />
                </svg>
                </a>

                <a href="#" class="bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-full inline-flex items-center space-x-2">
                    Comprar Ahora
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

        </div>
    </section>
    <!-- Boton Vender -->
    <div class="text-center mt-5">
        <!-- Botón de acción "Vender en Ecobazar" arriba del contenido -->
            <a href="#" class="inline-block mb-4 px-6 py-5 bg-green-600 text-white font-semibold rounded-full hover:bg-green-700 text-xl">
                Vender en Ecobazar
            </a>
    </div>
    <!--Cards Izquierda-->
    <section class="py-16 bg-white px-20">
        <div class="container mx-auto flex flex-col lg:flex-row items-center justify-between"> <!-- Cambié justify-between por justify-start -->
            <!-- Imagen del agricultor -->
            <div class="lg:w-1/2 mb-8 lg:mb-0"> 
                <img src="{{ asset('images/ima1.png') }}" alt="Farmer Image" class="rounded-lg shadow-lg ">
            </div>
            <!-- Contenido textual -->
            <div class="lg:w-1/2 lg:pl-12 lg:mb-0 text-left lg:text-left">
                <h3 class="text-6xl font-bold text-gray-800 mb-0">Feria Organizada por <span class="text-black">Islas de Paz</span></h3><br>
                <p class="text-gray-600 mb-6">
                    Estamos haciendo que sea más fácil elegir los excelentes alimentos que se producen en nuestros propios centros alimentarios.
                </p>

                <!-- Lista de beneficios -->
                <ul class="text-gray-600 space-y-4 mb-8">
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-green-500 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Obtenga los alimentos locales más frescos y nutritivos disponibles durante todo el año
                    </li>
                    <li class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-green-500 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Apoye los intereses de los pequeños productores de alimentos de su comunidad
                    </li>
                </ul>

                <!-- Texto adicional -->
                <p class="text-gray-600 mb-6">
                    Ecobazar aumenta el acceso de la comunidad a productos elaborados y cultivados localmente a través de este sistema alimentario reestructurado, que a su vez, sirve a nuestro planeta y a nuestro sentido de identidad y soberanía basado en el lugar.
                </p>
                <p class="text-gray-600 mb-8">
                    ¡Estamos emocionados de que se una a nuestra misión y ponga su dinero donde está su corazón!
                </p>

                <!-- Botón de acción -->
                <a href="#" class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-full hover:bg-green-700">
                    Comprar Ahora
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>
        </div>
    </section>
    <!--Cards Derecha-->
    <section class="py-16 bg-white px-20">
        <div class="container mx-auto flex flex-col lg:flex-row items-center justify-between">
            <!-- Contenido textual -->
            <div class="lg:w-1/2 lg:pr-16">
                <h2 class="text-green-600 text-6xl font-semibold mb-4">Vender en Ecobazar</h2>
                <br>
                <p class="text-gray-600 mb-6">
                    Ecobazar es un mercado colaborativo que reúne a varios agricultores y productores en una tienda local en línea. Así es como funciona:
                </p>

                <!-- Lista de pasos -->
                <ul class="text-gray-600 space-y-4 mb-8">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-green-500 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Los compradores realizan pedidos según su disponibilidad cada semana y pagan por adelantado.
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-green-500 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Un Market Hub Manager dedicado recibe sus productos por cliente y almacena pedidos de los clientes.
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-6 h-6 text-green-500 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        Los clientes recogen sus pedidos en un lugar de recogida designado.
                    </li>
                </ul>

                <!-- Texto adicional -->
                <p class="text-gray-600 mb-8">
                    Este modelo prepago de cosecha bajo pedido reduce el desperdicio al garantizar que sus clientes obtengan sus productos más frescos mientras usted hace un uso eficiente de su mano de obra, producto y tiempo.
                </p>

                <!-- Botón de acción -->
                <a href="#" class="inline-flex items-center px-6 py-3 bg-green-600 text-white font-semibold rounded-full hover:bg-green-700">
                    Empezar Ahora
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-5 h-5 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </a>
            </div>

            <!-- Imagen a la derecha -->
            <div class="lg:w-1/2 mt-8 lg:mt-0">
                <img src="{{ asset('images/ima2.png') }}" alt="Farmer Image" class="rounded-lg shadow-lg">
            </div>
        </div>
    </section>

@endsection
