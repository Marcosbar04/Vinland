<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\PedidoItem;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class FacturaController extends Controller
{
    public function generarFactura(Pedido $pedido)
    {
        // Verificar que el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para acceder a esta sección');
        }
        
        $usuario = Auth::user();
        
        // Verificar que el usuario tiene acceso a este pedido
        // CAMBIO: Permitir acceso si es admin O si es el dueño del pedido
        if ($pedido->id_usuario != $usuario->id && $usuario->rol !== 'admin') {
            return redirect()->route('pedidos.index')->with('error', 'No tienes permiso para acceder a esta factura');
        }
        
        // Actualizar el estado del pedido a pagado solo si viene del usuario (no admin)
        if ($pedido->estado == 'pendiente' && $usuario->rol !== 'admin') {
            $pedido->estado = 'pagado';
            $pedido->save();
        }
        
        // Cargar las relaciones necesarias
        $pedido->load(['items.vinilo', 'usuario']);
        
        $costo_envio = 5.00;
        $total = $pedido->precio_total + $costo_envio;
        
        $data = [
            'pedido' => $pedido,
            'usuario' => $pedido->usuario, // Usar el usuario del pedido, no el logueado
            'items' => $pedido->items,
            'fecha' => $pedido->fecha_creacion ? Carbon::parse($pedido->fecha_creacion)->format('d/m/Y H:i') : Carbon::now()->format('d/m/Y H:i'),
            'numero_factura' => 'F-'.str_pad($pedido->id, 6, '0', STR_PAD_LEFT),
            'costo_envio' => $costo_envio,
            'total' => $total
        ];
        
        $pdf = Pdf::loadView('facturas.factura', $data);
        
        return $pdf->download('factura-'.$data['numero_factura'].'.pdf');
    }
}
