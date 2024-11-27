<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Time;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class EscudoController extends Controller
{
public function saveImages()
    {
        $times = Time::all();
        foreach($times as $time){
            $url = $time->escudo;
            $response = Http::get($url);

            $filename = pathinfo($url, PATHINFO_BASENAME);
            // Save the image to the local disk
            Storage::disk('public')->put($filename, $response->body());
            $publicUrl = Storage::disk('public')->url($filename);
            $time->escudo = $publicUrl;
            $time->save();
        }
        return response()->json(['message' => 'Images saved successfully']);
    }
}
