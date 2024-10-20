<?php

namespace App\Http\Controllers;
use App\Models\Canasta;
use App\Models\Product;

use Illuminate\Http\Request;

class CanastaController extends Controller
{
    public function index()
    {
        $canastas = Canasta::all();
        return view('admin.canastas.index', compact('canastas'));
    }

    public function create()
{
    $productos = Product::all(); // Obtener todos los productos
    return view('admin.canastas.create', compact('productos'));
}



public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'precio' => 'required|numeric',
        'descripcion' => 'nullable|string',
    ]);

    $canasta = Canasta::create($request->only(['nombre', 'precio', 'descripcion']));

    // Guardar productos seleccionados en la canasta
    if ($request->has('productos')) {
        foreach ($request->productos as $productoId => $detalle) {
            $canasta->productos()->attach($productoId, ['cantidad' => $detalle['cantidad']]);
        }
    }

    return redirect()->route('admin.canastas.index')->with('success', 'Canasta creada con éxito.');
}



    public function edit(Canasta $canasta)
    {
        return view('admin.canastas.edit', compact('canasta'));
    }

    public function update(Request $request, Canasta $canasta)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric',
            'descripcion' => 'nullable|string',
        ]);

        $canasta->update($request->all());

        return redirect()->route('admin.canastas.index')->with('success', 'Canasta actualizada con éxito.');
    }

    public function destroy(Canasta $canasta)
    {
        $canasta->delete();

        return redirect()->route('admin.canastas.index')->with('success', 'Canasta eliminada con éxito.');
    }
}
