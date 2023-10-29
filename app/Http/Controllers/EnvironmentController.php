<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class EnvironmentController extends Controller
{
    public function index()
    {
        $disk       = Storage::disk('s3');
        $content    = $disk->get('weather.json');
        $data       = json_decode($content, true);

        return view('index', compact('data'));
    }
}
