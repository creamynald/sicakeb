<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class frontendController extends Controller
{
    public function index()
    {   
        // Data untuk chart pie
        $data = [
            'labels' => ['2021', '2022', '2023'],
            'values' => [67.12, 67.44, 67.60]
        ];

        return view('frontend.beranda.index', compact('data'));
    }
}
