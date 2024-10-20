    @extends('layouts.app')

    @section('content')
    <div class="container mx-auto mt-12 max-w-3xl">
        <h1 class="text-3xl font-bold mb-6">Gestionar Canastas</h1>

        <!-- Formulario para crear nueva canasta -->
        <form action="{{ route('admin.canastas.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-4">
                <input type="text" name="nombre" placeholder="Nombre de la Canasta" class="border p-2 w-full" required>
            </div>
            <div class="mb-4">
                <input type="number" name="precio" placeholder="Precio de la Canasta" class="border p-2 w-full" required>
            </div>
            <div class="mb-4">
                <textarea name="descripcion" placeholder="Descripción de la Canasta" class="border p-2 w-full"></textarea>
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg">Crear Canasta</button>
        </form>

        <!-- Tabla de canastas -->
        <table class="w-full border-collapse">
            <thead>
                <tr>
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nombre</th>
                    <th class="border px-4 py-2">Precio</th>
                    <th class="border px-4 py-2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($canastas as $canasta)
                <tr>
                    <td class="border px-4 py-2">{{ $canasta->id }}</td>
                    <td class="border px-4 py-2">{{ $canasta->nombre }}</td>
                    <td class="border px-4 py-2">S/{{ $canasta->precio }}</td>
                    <td class="border px-4 py-2">
                        <!-- Botón para editar -->
                        <a href="{{ route('admin.canastas.edit', $canasta->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Editar</a>
                        
                        <!-- Formulario para eliminar -->
                        <form action="{{ route('admin.canastas.destroy', $canasta->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg ml-2">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endsection
