<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\CarritoItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class CarritoController extends Controller
{
    public function index()
    {
        $carrito = Carrito::where('user_id', Auth::id())->with('items.product')->first();
        return view('carrito.index', compact('carrito'));
    }

    public function add(Request $request, $productId)
{
    $producto = Product::findOrFail($productId);
    $carrito = Carrito::firstOrCreate(['user_id' => Auth::id()]);

    $item = $carrito->items()->where('producto_id', $productId)->first();

    if ($item) {
        $item->cantidad += $request->input('cantidad', 1);
        $item->save();
    } else {
        $item = CarritoItem::create([
            'carrito_id' => $carrito->id,
            'producto_id' => $productId,
            'cantidad' => $request->input('cantidad', 1),
        ]);
    }

    // Si la solicitud es AJAX, devolvemos una respuesta JSON
    if ($request->ajax()) {
        $carrito->load('items.product'); // Cargar relación para usar en la respuesta

        $totalItems = $carrito->items->sum('cantidad');  // Total de productos en el carrito
        $totalPrice = $carrito->items->sum(function ($item) {
            return $item->product->precio * $item->cantidad;
        });

        // Preparar los items del carrito para enviar al frontend
        $carritoItems = $carrito->items->map(function($item) {
            return [
                'nombre' => $item->product->nombre,
                'cantidad' => $item->cantidad,
                'precio' => $item->product->precio,
            ];
        });

        return response()->json([
            'totalItems' => $totalItems,
            'totalPrice' => $totalPrice,
            'carritoItems' => $carritoItems,
        ]);
    }

    // Si no es AJAX, redirige al carrito (comportamiento normal)
    return redirect()->route('carrito.index');
}




    public function remove($itemId)
    {
        $item = CarritoItem::findOrFail($itemId);
        $item->delete();

        return redirect()->route('carrito.index');
    }

    public function update(Request $request, $itemId)
    {
        $item = CarritoItem::findOrFail($itemId);
        $item->cantidad = $request->input('cantidad');
        $item->save();

        return redirect()->route('carrito.index');
    }
    
}