<?php

namespace App\Http\Controllers;

use App\Models\Vinilo;
use App\Models\Usuario;
use App\Models\Pedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // Middleware personalizado en el constructor
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Verificación manual de admin
    private function checkAdmin()
    {
        if (!Auth::check() || Auth::user()->rol !== 'admin') {
            abort(403, 'Acceso no autorizado');
        }
    }
    
    public function dashboard()
    {
        $this->checkAdmin();
        
        // Estadísticas para el dashboard
        $totalVinilos = Vinilo::count();
        $totalUsuarios = Usuario::count();
        $totalPedidos = Pedido::where('estado', '!=', 'carrito')->count();
        $ventasTotal = Pedido::where('estado', 'pagado')->sum('precio_total');
        
        return view('admin.dashboard', compact(
            'totalVinilos', 
            'totalUsuarios', 
            'totalPedidos', 
            'ventasTotal'
        ));
    }
    
    // GESTIÓN DE VINILOS
    public function vinilosIndex(Request $request)
    {
        $this->checkAdmin();
        
        $busqueda = $request->query('busqueda');
        
        $vinilos = Vinilo::when($busqueda, function ($query, $busqueda) {
                return $query->where('titulo', 'like', "%{$busqueda}%")
                    ->orWhere('artista', 'like', "%{$busqueda}%");
            })
            ->orderBy('fecha_creacion', 'desc')
            ->Paginate(10); // Cambiado a simplePaginate
            
        return view('admin.vinilos.index', compact('vinilos', 'busqueda'));
    }
    
    public function usuariosIndex(Request $request)
    {
        $this->checkAdmin();
        
        $busqueda = $request->query('busqueda');
        
        $usuarios = Usuario::when($busqueda, function ($query, $busqueda) {
                return $query->where('nombre', 'like', "%{$busqueda}%")
                    ->orWhere('email', 'like', "%{$busqueda}%")
                    ->orWhere('username', 'like', "%{$busqueda}%");
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('admin.usuarios.index', compact('usuarios', 'busqueda'));
    }
    
    public function usuarioShow(Usuario $usuario)
    {
        $this->checkAdmin();
        
        $pedidos = $usuario->pedidos()
            ->where('estado', '!=', 'carrito')
            ->orderBy('fecha_creacion', 'desc')
            ->get();
            
        return view('admin.usuarios.show', compact('usuario', 'pedidos'));
    }

public function usuarioConfirmDelete(Usuario $usuario)
{
    $this->checkAdmin();
    
    return view('admin.usuarios.confirm-delete', compact('usuario'));
}

public function usuarioDestroy(Usuario $usuario)
{
    $this->checkAdmin();
    
    if (Auth::id() === $usuario->id) {
        return redirect()->route('admin.usuarios.index')
            ->with('error', 'No puedes eliminar tu propia cuenta de administrador');
    }
    
    $nombreUsuario = $usuario->nombre_completo;
    
    $usuario->delete();
    
    return redirect()->route('admin.usuarios.index')
        ->with('success', "Usuario '$nombreUsuario' eliminado correctamente");
}
    
    public function usuarioEdit(Usuario $usuario)
    {
        $this->checkAdmin();
        
        return view('admin.usuarios.edit', compact('usuario'));
    }

    public function usuarioCreate()
{
    $this->checkAdmin();
    return view('admin.usuarios.create');
}
    
    public function usuarioUpdate(Request $request, Usuario $usuario)
    {
        $this->checkAdmin();
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:Usuarios,email,'.$usuario->id,
            'username' => 'required|string|max:255|unique:Usuarios,username,'.$usuario->id,
            'rol' => 'required|in:admin,cliente',
        ]);
        
        $usuario->nombre = $request->nombre;
        $usuario->apellido = $request->apellido;
        $usuario->email = $request->email;
        $usuario->username = $request->username;
        $usuario->rol = $request->rol;
        $usuario->save();
        
        return redirect()->route('admin.usuarios.index')
            ->with('success', 'Usuario actualizado correctamente');
    }
    
    // PEDIDOS
    public function pedidosIndex()
    {
        $this->checkAdmin();
        
        $pedidos = Pedido::where('estado', '!=', 'carrito')
            ->with('usuario')
            ->orderBy('fecha_creacion', 'desc')
            ->paginate(10);
            
        return view('admin.pedidos.index', compact('pedidos'));
    }
    
    public function pedidoShow(Pedido $pedido)
    {
        $this->checkAdmin();
        
        $pedido->load(['items.vinilo', 'usuario']);
        return view('admin.pedidos.show', compact('pedido'));
    }
    
    public function pedidoUpdate(Request $request, Pedido $pedido)
    {
        $this->checkAdmin();
        
        $request->validate([
            'estado' => 'required|in:pendiente,pagado,cancelado'
        ]);
        
        $pedido->estado = $request->estado;
        $pedido->save();
        
        return redirect()->route('admin.pedidos.show', $pedido)
            ->with('success', 'Estado del pedido actualizado correctamente');
    }
}