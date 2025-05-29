<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use App\Models\Usuario;

class UsuarioController extends Controller
{

    public function show(Request $request)
    {
        $usuario = $request->user(); 
        return view('perfil.show', compact('usuario'));
    }


    public function edit(Request $request)
    {
        $usuario = $request->user();
        return view('perfil.edit', compact('usuario'));
    }

   public function update(Request $request)
{
    $usuario = $request->user();
    
    // Validar datos
    $validated = $request->validate([
        'username' => ['required', 'string', 'max:255', Rule::unique('Usuarios')->ignore($usuario->id)],
        'first_name' => 'required|string|max:255',
        'last_name' => 'required|string|max:255',
        'email' => ['required', 'email', 'max:255', Rule::unique('Usuarios')->ignore($usuario->id)],
        'profile_image' => 'nullable|image|max:2048',
    ]);

    // Manejar imagen de perfil
    if ($request->hasFile('profile_image')) {
        $this->updateProfileImage($usuario, $request->file('profile_image'));
    }

    // Actualizar datos del usuario
    $usuario->update([
        'username' => $validated['username'],
        'nombre' => $validated['first_name'],
        'apellido' => $validated['last_name'],
        'email' => $validated['email'],
    ]);

    return redirect()->route('perfil.show')->with('success', 'Perfil actualizado correctamente.');
}

private function updateProfileImage($usuario, $image)
{
    // Eliminar imagen anterior si existe y no es la por defecto
    if ($usuario->profile_image && $usuario->profile_image !== 'img/default-profile.png') {
        Storage::delete('public/' . str_replace('storage/', '', $usuario->profile_image));
    }
    
    // Guardar nueva imagen
    $imagePath = $image->store('profile_images', 'public');
    $usuario->profile_image = $imagePath;
    $usuario->save();
}

  
    public function cambiarContrasena(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $usuario = $request->user();

        if (!Hash::check($request->current_password, $usuario->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta']);
        }

        $usuario->password = Hash::make($request->new_password);
        $usuario->save();

        return redirect()->route('perfil.show')->with('success', 'Contraseña actualizada correctamente.');
    }


    public function confirmDelete(Request $request)
    {
        return view('perfil.confirm-delete');
    }

    public function destroy(Request $request)
    {
        $usuario = $request->user();
        
        $request->validate([
            'password' => 'required',
        ]);

        if (!Hash::check($request->password, $usuario->password)) {
            return back()->withErrors(['password' => 'La contraseña no es correcta']);
        }

        if ($usuario->profile_image && $usuario->profile_image !== 'img/default-profile.png') {
            Storage::delete('public/' . $usuario->profile_image);
        }

        Auth::logout();
        
        $usuario->delete();

        return redirect()->route('home')->with('success', 'Tu cuenta ha sido eliminada correctamente.');
    }
}
