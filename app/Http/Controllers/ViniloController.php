<?php

namespace App\Http\Controllers;

use App\Models\Vinilo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ViniloController extends Controller
{
   
    public function index(Request $request)
    {
        $vinilos = Vinilo::query()
            ->orderBy('fecha_creacion', 'desc')
            ->paginate(6);
        
        return view('vinilos.index', [
            'vinilos' => $vinilos,
            'esAdmin' => $request->user() && $request->user()->rol === 'admin'
        ]);
    }


    public function create(Request $request)
    {
        if (!$request->user() || $request->user()->rol !== 'admin') {
            return redirect()->route('vinilos.index')
                            ->with('error', 'No tienes permiso para esta acción');
        }
        
        return view('vinilos.create');
    }

public function store(Request $request)
{
    if (!$request->user() || $request->user()->rol !== 'admin') {
        return redirect()->route('vinilos.index')
                        ->with('error', 'No tienes permiso para esta acción');
    }
    
    $validated = $this->validateVinilo($request);
    
    $validated['imagen'] = $this->guardarArchivo($request, 'imagen', 'vinilos');
    
    if ($request->has('preview_audio_path') && !empty($request->preview_audio_path)) {
        $validated['preview_audio'] = $request->preview_audio_path;
    } else {
        $validated['preview_audio'] = null;
    }
    
    Vinilo::create($validated);

    return redirect()->route('vinilos.index')
                    ->with('success', 'Vinilo creado exitosamente');
}

    public function show(Vinilo $vinilo, Request $request)
    {
        $userLike = null;
        
        if ($request->user()) {
            $userLike = $vinilo->likes()
                             ->where('id_usuario', $request->user()->id)
                             ->first();
        }
        
        return view('vinilos.show', [
            'vinilo' => $vinilo,
            'userLike' => $userLike,
            'esAdmin' => $request->user() && $request->user()->rol === 'admin'
        ]);
    }

    public function edit(Vinilo $vinilo, Request $request)
    {
        if (!$request->user() || $request->user()->rol !== 'admin') {
            return redirect()->route('vinilos.index')
                            ->with('error', 'No tienes permiso para esta acción');
        }
        
    $usuario = $request->user();
    
    return view('vinilos.edit', compact('vinilo', 'usuario'));
    }
    public function mostrarViniloAleatorio(Request $request)
    {
        $vinilo = Vinilo::inRandomOrder()->first();
        
        $userLike = null;
        
        if ($request->user()) {
            $userLike = $vinilo->likes()
                             ->where('id_usuario', $request->user()->id)
                             ->first();
        }
        
        return view('vinilos.aleatorio', [
            'vinilo' => $vinilo,
            'userLike' => $userLike,
            'esAdmin' => $request->user() && $request->user()->rol === 'admin'
        ]);
    }
    
    public function update(Request $request, Vinilo $vinilo)
    {
        if (!$request->user() || $request->user()->rol !== 'admin') {
            return redirect()->route('vinilos.index')
                            ->with('error', 'No tienes permiso para esta acción');
        }
        
        $validated = $this->validateVinilo($request, true);

        if ($request->hasFile('imagen')) {
            $this->eliminarArchivo($vinilo->imagen);
            $validated['imagen'] = $this->guardarArchivo($request, 'imagen', 'vinilos');
        }
        
        if ($request->has('preview_audio_path') && !empty($request->preview_audio_path)) {
        $validated['preview_audio'] = $request->preview_audio_path;
        }

        
        $vinilo->update($validated);

        return redirect()->route('vinilos.show', $vinilo)
                        ->with('success', 'Vinilo actualizado exitosamente');
    }

    public function destroy(Vinilo $vinilo, Request $request)
    {
        if (!$request->user() || $request->user()->rol !== 'admin') {
            return redirect()->route('vinilos.index')
                            ->with('error', 'No tienes permiso para esta acción');
        }
        
        $this->eliminarArchivo($vinilo->imagen);
        $this->eliminarArchivo($vinilo->preview_audio);
        
        $vinilo->delete();

        return redirect()->route('vinilos.index')
                        ->with('success', 'Vinilo eliminado exitosamente');
    }

private function validateVinilo(Request $request, $isUpdate = false)
{
    $rules = [
        'titulo' => 'required|string|max:255',
        'artista' => 'required|string|max:255',
        'genero' => 'required|string|max:100',
        'anio' => 'required|integer|min:1900|max:'.(date('Y')+1),
        'precio_unitario' => 'required|numeric|min:0',
        'visible' => 'sometimes|boolean',
        'preview_audio_path' => 'nullable|string',
    ];
    
    if (!$isUpdate) {
        $rules['imagen'] = 'required|image|mimes:jpeg,png,jpg,gif|max:2048';
    } else {
        $rules['imagen'] = 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048';
    }
    
    return $request->validate($rules);
}
    
private function guardarArchivo(Request $request, $field, $folder)
{
    if ($request->hasFile($field) && $request->file($field)->isValid()) {
        $file = $request->file($field);
        $filename = time() . '_' . $file->getClientOriginalName();
        
        $path = storage_path('app/public/' . $folder);
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        
        $storedPath = $file->storeAs($folder, $filename, 'public');
        
        if (!$storedPath) {
            
            return null;
        }
        
        return $storedPath;
    }
    
    return null;
}
    
    private function eliminarArchivo($path)
    {
        if ($path) {
            Storage::disk('public')->delete($path);
        }
    }
}
