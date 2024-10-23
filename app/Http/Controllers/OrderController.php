<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order; // Asumiendo que tienes un modelo Order
use App\Models\Carrito;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;


class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Validar los datos de la solicitud
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'empresa' => 'nullable|string|max:255',
            'email' => 'required|email',
            'telefono' => 'required|string|max:20',
            'delivery' => 'required|string',
            'direccion' => 'required_if:delivery,delivery|string|max:255',
            'distrito' => 'required_if:delivery,delivery|string|max:255',
            'pago' => 'required|string',
        ]);

        // Obtener el carrito del usuario
        $carrito = Carrito::where('user_id', Auth::id())->with('items.product')->first();

        if (!$carrito || $carrito->items->isEmpty()) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }

        // Crear la orden (suponiendo que tienes un modelo Order)
        $order = Order::create([
            'user_id' => Auth::id(),
            'nombre' => $request->input('nombre'),
            'apellido' => $request->input('apellido'),
            'empresa' => $request->input('empresa'),
            'email' => $request->input('email'),
            'telefono' => $request->input('telefono'),
            'delivery' => $request->input('delivery'),
            'direccion' => $request->input('direccion'),
            'distrito' => $request->input('distrito'),
            'pago' => $request->input('pago'),
            'total' => $carrito->total() + 8.00, // Asumiendo un costo de envío fijo
        ]);

        // Asociar los productos del carrito con la orden
        foreach ($carrito->items as $item) {
            $order->items()->create([
                'producto_id' => $item->producto_id,
                'cantidad' => $item->cantidad,
                'precio' => $item->product->precio,
            ]);
        }

        // Vaciar el carrito después de realizar la orden
        $carrito->items()->delete();

        return redirect()->route('order.success', ['orderId' => $order->id])->with('success', 'Tu pedido ha sido realizado con éxito.');

    }
    public function success($orderId)
    {
        $orden = Order::with('items.product')->findOrFail($orderId);
    
        // Calcular el subtotal sumando todos los productos de la orden
        $subtotal = $orden->items->sum(function($item) {
            return $item->precio * $item->cantidad;
        });
    
        // Asignar el costo de envío dependiendo del tipo de entrega
        $envio = $orden->delivery == 'delivery' ? 8.00 : 0.00;
    
        // Asignar los valores calculados a la orden
        $orden->subtotal = $subtotal;
        $orden->envio = $envio;
    
        return view('order.success', compact('orden'));
    }
    

    public function downloadVoucher($orderId)
    {
        $orden = Order::with('items.product')->findOrFail($orderId);
    
        // Calcular el subtotal sumando todos los productos de la orden
        $subtotal = $orden->items->sum(function($item) {
            return $item->precio * $item->cantidad;
        });
    
        // Asignar el costo de envío dependiendo del tipo de entrega
        $envio = $orden->delivery == 'delivery' ? 8.00 : 0.00;
    
        // Asignar los valores calculados a la orden
        $orden->subtotal = $subtotal;
        $orden->envio = $envio;
    
        // Calcular el total
        $orden->total = $subtotal + $envio;
    
        $pdf = PDF::loadView('order.voucher', compact('orden'));
        return $pdf->download('voucher_orden_' . $orderId . '.pdf');
    }
    

public function voucher($orderId)
{
    $orden = Order::with('items.product')->findOrFail($orderId);

    // Calcular el subtotal sumando todos los productos de la orden
    $subtotal = $orden->items->sum(function($item) {
        return $item->precio * $item->cantidad;
    });

    // Asignar el costo de envío dependiendo del tipo de entrega
    $envio = $orden->delivery == 'delivery' ? 8.00 : 0.00;

    // Asignar los valores calculados a la orden (necesitas hacerlo manualmente para que estén disponibles en la vista)
    $orden->subtotal = $subtotal;
    $orden->envio = $envio;

    // Calcular el total
    $orden->total = $subtotal + $envio;

    // Retornar la vista del voucher
    return view('order.voucher', compact('orden'));
}





}
