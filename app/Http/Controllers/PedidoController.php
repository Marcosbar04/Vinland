<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vinilo;
use App\Models\Pedido;
use App\Models\PedidoItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PedidoController extends Controller
{

    private function checkAuth()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta sección');
        }
        return true;
    }
    

    public function index()
    {
        $auth = $this->checkAuth();
        if ($auth !== true) {
            return $auth; 
        }
        
        $usuario = Auth::user();
        $pedidos = Pedido::where('id_usuario', $usuario->id)
                        ->where('estado', '!=', 'carrito')
                        ->orderBy('fecha_creacion', 'desc')
                        ->with('items.vinilo')
                        ->paginate(10);
        
        return view('pedidos.index', compact('pedidos'));
    }
    

    public function showCart()
    {
        $auth = $this->checkAuth();
        if ($auth !== true) {
            return $auth; 
        }
        
        $usuario = Auth::user();
        
        $pedido = Pedido::where('id_usuario', $usuario->id)
                      ->where('estado', 'carrito')
                      ->with('items.vinilo')
                      ->first();
        
        if (!$pedido) {
            $pedido = Pedido::create([
                'id_usuario' => $usuario->id,
                'estado' => 'carrito',
                'precio_total' => 0
            ]);
        }
        
        return view('pedidos.carrito', compact('pedido'));
    }
    

    public function addToCart(Request $request, Vinilo $vinilo)
    {
        $auth = $this->checkAuth();
        if ($auth !== true) {
            return $auth; 
        }
        
        $request->validate([
            'cantidad' => 'required|integer|min:1|max:10'
        ]);
        
        $cantidad = $request->cantidad;
        $usuario = Auth::user();
        
        $pedido = Pedido::where('id_usuario', $usuario->id)
                      ->where('estado', 'carrito')
                      ->first();
                      
        if (!$pedido) {
            $pedido = Pedido::create([
                'id_usuario' => $usuario->id,
                'estado' => 'carrito',
                'precio_total' => 0
            ]);
        }
        
        $existingItem = PedidoItem::where('id_pedido', $pedido->id)
                                ->where('id_vinilo', $vinilo->id)
                                ->first();
        
        if ($existingItem) {
            $existingItem->cantidad += $cantidad;
            $existingItem->save();
        } else {
            PedidoItem::create([
                'id_pedido' => $pedido->id,
                'id_vinilo' => $vinilo->id,
                'cantidad' => $cantidad,
                'precio_unitario' => $vinilo->precio_unitario
            ]);
        }
        
        $this->actualizarPrecioTotal($pedido);
        
        return redirect()->route('pedidos.carrito')
                        ->with('success', 'Vinilo añadido al carrito correctamente');
    }
    

    public function updateCartItem(Request $request, $item)
    {
        $auth = $this->checkAuth();
        if ($auth !== true) {
            return $auth; 
        }
        
        $request->validate([
            'cantidad' => 'required|integer|min:1|max:10'
        ]);
        
        $pedidoItem = PedidoItem::findOrFail($item);
        
        $usuario = Auth::user();
        $pedido = Pedido::findOrFail($pedidoItem->id_pedido);
        
        if ($pedido->id_usuario != $usuario->id || $pedido->estado != 'carrito') {
            return redirect()->route('pedidos.carrito')
                            ->with('error', 'No tienes permiso para modificar este item');
        }
        
        $pedidoItem->cantidad = $request->cantidad;
        $pedidoItem->save();
        
        $this->actualizarPrecioTotal($pedido);
        
        return redirect()->route('pedidos.carrito')
                        ->with('success', 'Carrito actualizado correctamente');
    }
    

    public function removeFromCart($item)
    {
        $auth = $this->checkAuth();
        if ($auth !== true) {
            return $auth; 
        }
        
        $pedidoItem = PedidoItem::findOrFail($item);
        
        $usuario = Auth::user();
        $pedido = Pedido::findOrFail($pedidoItem->id_pedido);
        
        if ($pedido->id_usuario != $usuario->id || $pedido->estado != 'carrito') {
            return redirect()->route('pedidos.carrito')
                            ->with('error', 'No tienes permiso para eliminar este item');
        }
        
        $pedidoItem->delete();
        
        $this->actualizarPrecioTotal($pedido);
        
        return redirect()->route('pedidos.carrito')
                        ->with('success', 'Producto eliminado del carrito');
    }
    

    private function actualizarPrecioTotal(Pedido $pedido)
    {
        $total = 0;
        foreach ($pedido->items as $item) {
            $total += $item->cantidad * $item->precio_unitario;
        }
        
        $pedido->precio_total = $total;
        $pedido->save();
    }
    

    public function checkout()
    {
        $auth = $this->checkAuth();
        if ($auth !== true) {
            return $auth; 
        }
        
        $usuario = Auth::user();
        
        $pedido = Pedido::where('id_usuario', $usuario->id)
                      ->where('estado', 'carrito')
                      ->with('items.vinilo')
                      ->first();
        
        if (!$pedido || $pedido->items->isEmpty()) {
            return redirect()->route('pedidos.carrito')
                            ->with('error', 'Tu carrito está vacío');
        }
        
        $pedido->estado = 'pendiente';
        $pedido->save();
        
        return redirect()->route('pedidos.index')
                        ->with('success', 'Tu pedido ha sido procesado correctamente');
    }
    

    public function cancelarPedido(Pedido $pedido)
    {
        $auth = $this->checkAuth();
        if ($auth !== true) {
            return $auth; 
        }
        
        $usuario = Auth::user();
        
        if ($pedido->id_usuario != $usuario->id) {
            return redirect()->route('pedidos.index')
                            ->with('error', 'No tienes permiso para cancelar este pedido');
        }
        
        if ($pedido->estado != 'pendiente') {
            return redirect()->route('pedidos.index')
                            ->with('error', 'Solo se pueden cancelar pedidos pendientes');
        }
        
        $pedido->estado = 'cancelado';
        $pedido->save();
        
        return redirect()->route('pedidos.index')
                        ->with('success', 'Pedido cancelado correctamente');
    }
}