<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function mostrarFormularioRegistro()
    {
        return view('auth.register');
    }
    
    public function mostrarFormularioRegistroAdmin()
    {
        if (!Auth::check() || Auth::user()->rol !== 'admin') {
            abort(403, 'Acceso no autorizado');
        }
    
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $mensajes = [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.string' => 'El nombre debe ser texto.',
            'nombre.max' => 'El nombre no puede tener más de :max caracteres.',
            
            'apellido.required' => 'El campo apellido es obligatorio.',
            'apellido.string' => 'El apellido debe ser texto.',
            'apellido.max' => 'El apellido no puede tener más de :max caracteres.',
            
            'username.required' => 'El nombre de usuario es obligatorio.',
            'username.string' => 'El nombre de usuario debe ser texto.',
            'username.max' => 'El nombre de usuario no puede tener más de :max caracteres.',
            'username.unique' => 'Este nombre de usuario ya está en uso.',
            
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.string' => 'El correo electrónico debe ser texto.',
            'email.email' => 'Introduce un correo electrónico válido.',
            'email.max' => 'El correo electrónico no puede tener más de :max caracteres.',
            'email.unique' => 'Este correo electrónico ya está registrado.',
            
            'password.required' => 'La contraseña es obligatoria.',
            'password.string' => 'La contraseña debe ser texto.',
            'password.min' => 'La contraseña debe tener al menos :min caracteres.',
            'password.confirmed' => 'La confirmación de contraseña no coincide.',
            
            'foto_perfil.image' => 'El archivo debe ser una imagen.',
            'foto_perfil.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif.',
            'foto_perfil.max' => 'La imagen no puede ser mayor de 2MB.',
            
            'rol.in' => 'El rol seleccionado no es válido.',
        ];

        $validationRules = [
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:Usuarios',
            'email' => 'required|string|email|max:255|unique:Usuarios',
            'password' => 'required|string|min:6|confirmed',
            'foto_perfil' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
        
        if (Auth::check() && Auth::user()->rol === 'admin') {
            $validationRules['rol'] = 'nullable|string|in:admin,usuario_registrado,cliente';
        }
        
        $request->validate($validationRules, $mensajes);

        // Imagen por defecto - NUNCA será null
        $profile_image = 'profile_images/default-profile.png';
        
        if ($request->hasFile('foto_perfil')) {
            $imagePath = $request->file('foto_perfil')->store('profile_images', 'public');
            $profile_image = $imagePath;
        }

        $rol = 'usuario_registrado';
        
        if (Auth::check() && Auth::user()->rol === 'admin' && $request->has('rol')) {
            $rol = $request->rol;
        }

        $usuario = Usuario::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'profile_image' => $profile_image, // Siempre tendrá un valor
            'rol' => $rol,
        ]);

        if (Auth::check() && Auth::user()->rol === 'admin') {
            return redirect()->route('admin.usuarios.index')
                ->with('success', 'Usuario creado correctamente');
        }

        Auth::login($usuario);
        return redirect()->route('vinilos.index')
            ->with('success', '¡Te has registrado correctamente!');
    }
}
