<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ViniloController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AudioUploadController;

// Página principal
Route::get('/', [ViniloController::class, 'index'])->name('home');

Route::middleware('guest')->group(function () {
    // Login
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'mostrarFormularioLogin')->name('login');
        Route::post('/login', 'login');
    });
    
    // Registro
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'mostrarFormularioRegistro')->name('register');
        Route::post('/register', 'register');  
    });
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth:web'])->group(function () { 
    Route::get('/dashboard', [ViniloController::class, 'index'])->name('dashboard');

    // Vinilos
    Route::resource('vinilos', ViniloController::class)->except(['index']);
    Route::get('/vinilos', [ViniloController::class, 'index'])->name('vinilos.index');
    Route::get('/vinilos/aleatorio', [ViniloController::class, 'mostrarViniloAleatorio'])->name('vinilos.random');

    // Pedidos
    Route::prefix('pedidos')->controller(PedidoController::class)->group(function () {
        Route::get('/', 'index')->name('pedidos.index');
        Route::get('/carrito', 'showCart')->name('pedidos.carrito');
        Route::post('/agregar/{vinilo}', 'addToCart')->name('pedidos.agregar');
        Route::put('/actualizar/{item}', 'updateCartItem')->name('pedidos.actualizar');
        Route::delete('/remover/{item}', 'removeFromCart')->name('pedidos.remover');
        Route::get('/checkout', 'checkout')->name('pedidos.checkout');
        Route::put('/cancelar/{pedido}', 'cancelarPedido')->name('pedidos.cancelar');
        Route::get('/vinilos/aleatorio', [ViniloController::class, 'mostrarViniloAleatorio'])->name('vinilos.random');
        Route::get('/facturas/descargar/{pedido}', [FacturaController::class, 'generarFactura'])->name('facturas.descargar');
    });

    // Likes
    Route::prefix('likes')->controller(LikeController::class)->group(function () {
        Route::post('/{vinilo}', 'toggleLike')->name('likes.toggle');
        Route::get('/favoritos', 'favorites')->name('likes.favoritos');
    });

    // Perfil
    Route::prefix('perfil')->controller(UsuarioController::class)->group(function () {
        Route::get('/', 'show')->name('perfil.show');
        Route::get('/editar', 'edit')->name('perfil.edit');
        Route::put('/', 'update')->name('perfil.update');
        Route::post('/cambiar-contrasena', 'cambiarContrasena')->name('perfil.cambiar-contrasena');
        Route::get('/eliminar', 'confirmDelete')->name('perfil.confirm-delete');
        Route::delete('/', 'destroy')->name('perfil.destroy');
    });
});

// Panel de Administración
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');

    // Gestión de Vinilos 
    Route::get('/vinilos', [AdminController::class, 'vinilosIndex'])->name('vinilos.index');

    // Gestión de Usuarios
    Route::get('/usuarios', [AdminController::class, 'usuariosIndex'])->name('usuarios.index');
    Route::get('/usuarios/{usuario}', [AdminController::class, 'usuarioShow'])->name('usuarios.show');
    Route::get('/usuarios/{usuario}/edit', [AdminController::class, 'usuarioEdit'])->name('usuarios.edit');
    Route::get('/usuarios/{usuario}/eliminar', [AdminController::class, 'usuarioConfirmDelete'])->name('usuarios.confirm-delete');
    Route::delete('/usuarios/{usuario}', [AdminController::class, 'usuarioDestroy'])->name('usuarios.destroy');
    Route::put('/usuarios/{usuario}', [AdminController::class, 'usuarioUpdate'])->name('usuarios.update');

    // Gestión de Pedidos
    Route::get('/pedidos', [AdminController::class, 'pedidosIndex'])->name('pedidos.index');
    Route::get('/pedidos/{pedido}', [AdminController::class, 'pedidoShow'])->name('pedidos.show');
    Route::put('/pedidos/{pedido}', [AdminController::class, 'pedidoUpdate'])->name('pedidos.update');
});

Route::get('/admin/register', [RegisterController::class, 'mostrarFormularioRegistroAdmin'])->name('admin.register');
Route::post('/filepond/process', '\Sopamo\LaravelFilepond\Http\Controllers\FilepondController@process');
Route::delete('/filepond/revert', '\Sopamo\LaravelFilepond\Http\Controllers\FilepondController@revert');
Route::post('/upload-audio', [AudioUploadController::class, 'uploadAudio'])->name('audio.upload');

Route::fallback(function () {
    return redirect()->route('home');
});
