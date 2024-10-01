<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Función para autorizar roles
    private function authorizeRoles($roles)
    {
        if (!Auth::check() || !in_array(Auth::user()->role, $roles)) {
            abort(403, 'No tienes autorización para acceder a esta página.');
        }
    }

    // Mostrar los productos del agricultor
    public function index()
    {
        // Autorizar solo a agricultores
        $this->authorizeRoles(['agricultor']);

        // Solo mostramos los productos del agricultor autenticado
        $productos = Product::where('user_id', Auth::id())->get();

        return view('productos.index', compact('productos'));
    }

    // Mostrar formulario de creación de productos
    public function create()
    {
        // Autorizar solo a agricultores
        $this->authorizeRoles(['agricultor']);

        return view('productos.create');
    }

    // Guardar un nuevo producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'cantidad_disponible' => 'required|integer',
        ]);

        Product::create([
            'user_id' => auth()->id(), // Asumiendo que los usuarios están autenticados
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'cantidad_disponible' => $request->cantidad_disponible,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
    }

    // Mostrar formulario de edición de producto
    public function edit(Product $producto)
    {
        // Autorizar solo a agricultores
        $this->authorizeRoles(['agricultor']);

        // Verificar que el producto pertenezca al agricultor autenticado
        if ($producto->user_id != Auth::id()) {
            abort(403, 'No tienes permiso para editar este producto.');
        }

        return view('productos.edit', compact('producto'));
    }

    // Actualizar el producto
    public function update(Request $request, Product $producto)
    {
        // Autorizar solo a agricultores
        $this->authorizeRoles(['agricultor']);

        // Verificar que el producto pertenezca al agricultor autenticado
        if ($producto->user_id != Auth::id()) {
            abort(403, 'No tienes permiso para actualizar este producto.');
        }

        $request->validate([
            'nombre' => 'required|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'cantidad_disponible' => 'required|integer',
        ]);

        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'cantidad_disponible' => $request->cantidad_disponible,
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
    }

    // Eliminar un producto
    public function destroy(Product $producto)
    {
        // Autorizar solo a agricultores
        $this->authorizeRoles(['agricultor']);

        // Verificar que el producto pertenezca al agricultor autenticado
        if ($producto->user_id != Auth::id()) {
            abort(403, 'No tienes permiso para eliminar este producto.');
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
}