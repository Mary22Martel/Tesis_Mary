<form action="{{ route('admin.canastas.store') }}" method="POST">
    @csrf
    <label for="nombre">Nombre de la Canasta:</label>
    <input type="text" name="nombre" required>

    <label for="precio">Precio:</label>
    <input type="number" name="precio" step="0.01" required>

    <label for="descripcion">Descripción:</label>
    <textarea name="descripcion"></textarea>

    <h3>Agregar Productos a la Canasta:</h3>
    @foreach($productos as $producto)
        <div>
            <input type="checkbox" name="productos[{{ $producto->id }}][id]" value="{{ $producto->id }}">
            <label>{{ $producto->nombre }} (Disponible: {{ $producto->cantidad_disponible }})</label>
            <input type="number" name="productos[{{ $producto->id }}][cantidad]" min="1" value="1">
        </div>
    @endforeach

    <button type="submit">Crear Canasta</button>
</form>
