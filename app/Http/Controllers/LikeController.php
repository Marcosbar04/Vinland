<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vinilo;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{

    public function toggleLike(Vinilo $vinilo)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para dar me gusta');
        }
        
        $usuario = Auth::user();
        
        $existingLike = Like::where('id_usuario', $usuario->id)
                           ->where('id_vinilo', $vinilo->id)
                           ->first();
        
        if ($existingLike) {
            $existingLike->delete();
            $message = 'Eliminado de tus favoritos';
        } else {
            Like::create([
                'id_usuario' => $usuario->id,
                'id_vinilo' => $vinilo->id,
                'me_gusta' => 1
            ]);
            $message = 'Añadido a tus favoritos';
        }
        
        if (request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'liked' => !$existingLike,
                'count' => $vinilo->likes()->count()
            ]);
        }
        
        return back()->with('success', $message);
    }
    

    public function favorites()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Debes iniciar sesión para ver tus favoritos');
        }
        
        $usuario = Auth::user();
        
        $vinilos = Vinilo::whereHas('likes', function($query) use ($usuario) {
            $query->where('id_usuario', $usuario->id)
                  ->where('me_gusta', 1);
        })->paginate(12);
        
        return view('likes.favoritos', compact('vinilos'));
    }
}