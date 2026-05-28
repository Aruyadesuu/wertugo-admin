<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $url = env('WERTUGO_API').'/admin/dashboard';
        $response = Http::get($url);

        $stats = [
            'total_user' => 0,
            'total_umkm' => 0,
            'total_verifikasi_pending' => 0
            ];

        if($response->successful()){
            // Timpa Nilai Default
            $stats = $response->json();
        }

        return view('pages.dashboard', ['stats' => $stats]);
    }
}
