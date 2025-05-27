<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AudioUploadController extends Controller
{
    public function uploadAudio(Request $request)
    {
        if (!$request->user() || $request->user()->rol !== 'admin') {
            return response()->json(['error' => 'No autorizado'], 403);
        }
        
        if ($request->has('resumableIdentifier') && $request->has('resumableChunkNumber')) {
            $resumableIdentifier = $request->input('resumableIdentifier');
            $resumableChunkNumber = intval($request->input('resumableChunkNumber'));
            $resumableTotalChunks = intval($request->input('resumableTotalChunks'));
            $resumableFilename = $request->input('resumableFilename');

            $temp_dir = storage_path('app/chunks/' . $resumableIdentifier);
            if (!file_exists($temp_dir)) {
                mkdir($temp_dir, 0755, true);
            } elseif (!is_dir($temp_dir)) {
                unlink($temp_dir);
                mkdir($temp_dir, 0755, true);
            }
            
            $chunkFile = $request->file('file');
            $chunk_path = $temp_dir . '/chunk-' . $resumableChunkNumber;
            
            file_put_contents($chunk_path, file_get_contents($chunkFile->getRealPath()));
            
            $allUploaded = true;
            for ($i = 1; $i <= $resumableTotalChunks; $i++) {
                if (!file_exists($temp_dir . '/chunk-' . $i)) {
                    $allUploaded = false;
                    break;
                }
            }
            
            if ($allUploaded) {
                $targetDir = storage_path('app/public/previews');
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0755, true);
                }
                
                $safeFilename = time() . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '_', $resumableFilename);
                $targetFile = $targetDir . '/' . $safeFilename;
                
                $target = fopen($targetFile, 'wb');
                for ($i = 1; $i <= $resumableTotalChunks; $i++) {
                    $chunk = fopen($temp_dir . '/chunk-' . $i, 'rb');
                    stream_copy_to_stream($chunk, $target);
                    fclose($chunk);
                }
                fclose($target);
                
                $this->deleteDirectory($temp_dir);
                
                return response()->json([
                    'success' => true,
                    'path' => 'previews/' . $safeFilename,
                    'url' => asset('storage/previews/' . $safeFilename)
                ]);
            }
            
            return response()->json(['success' => true]);
        }
        
        if ($request->hasFile('file') && $request->file('file')->isValid()) {
            $file = $request->file('file');
            $filename = time() . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '_', $file->getClientOriginalName());
            
            $path = storage_path('app/public/previews');
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            
            $storedPath = $file->storeAs('previews', $filename, 'public');
            
            return response()->json([
                'success' => true,
                'path' => $storedPath,
                'url' => asset('storage/' . $storedPath)
            ]);
        }
        
        return response()->json(['error' => 'No se ha subido ningún archivo'], 400);
    }
    
    private function deleteDirectory($dir) {
        if (!file_exists($dir)) {
            return true;
        }
        
        if (!is_dir($dir)) {
            return unlink($dir);
        }
        
        foreach (scandir($dir) as $item) {
            if ($item == '.' || $item == '..') {
                continue;
            }
            
            if (!$this->deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
                return false;
            }
        }
        
        return rmdir($dir);
    }
}