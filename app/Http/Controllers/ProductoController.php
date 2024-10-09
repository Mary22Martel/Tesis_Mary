<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('tienda', 'buscarProductos');
    }

    public function buscarProductos(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return response()->json([
                'productos' => []
            ]);
        }

        // Buscar productos que coincidan con el término de búsqueda
        $productos = Product::where('nombre', 'like', '%' . $query . '%')
            ->orWhere('descripcion', 'like', '%' . $query . '%')
            ->get();

        // Si no se encuentran productos, devolver un array vacío
        if ($productos->isEmpty()) {
            return response()->json([
                'productos' => []
            ]);
        }

        return response()->json([
            'productos' => $productos
        ]);
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
        // Autorizar solo a agricultores
        $this->authorizeRoles(['agricultor']);

        $request->validate([
            'nombre' => 'required|string|max:255',
            'medida' => 'required|max:100',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'cantidad_disponible' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria' => 'required|string|max:255'
        ]);

        // Subir la imagen
        $imagePath = null;
        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('productos', 'public');
        }

        Product::create([
            'user_id' => auth()->id(),
            'nombre' => $request->nombre,
            'medida' => $request->medida,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'cantidad_disponible' => $request->cantidad_disponible,
            'imagen' => $imagePath,
            'categoria' => $request->categoria
        ]);

        return redirect()->route('productos.index')->with('success', 'Producto creado con éxito.');
    }

    // Mostrar formulario de edición de producto
    public function edit(Product $producto)
    {
        //dd(Auth::id(), $producto->user_id);
        // Autorizar solo a agricultores
        $this->authorizeRoles(['agricultor']);

        // Verificar que el producto pertenezca al agricultor autenticado
        // if ($producto->user_id != Auth::id()) {
        //     abort(403, 'No tienes permiso para editar este producto.');
        // }

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
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'categoria' => 'required|string|max:255'
        ]);

        // Manejar la subida de imagen si hay una nueva
        if ($request->hasFile('imagen')) {
            $imagePath = $request->file('imagen')->store('productos', 'public');
            $producto->update(['imagen' => $imagePath]);
        }

        // Actualizar el producto
        $producto->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'precio' => $request->precio,
            'cantidad_disponible' => $request->cantidad_disponible,
            'categoria' => $request->categoria
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

        // Eliminar el producto
        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }
    public function tienda()
    {
        // Obtener todos los productos disponibles
        $productos = Product::all(); // Aquí puedes añadir filtros si es necesario

        return view('tienda', compact('productos'));
    }
}
