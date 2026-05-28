<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function index(){
        $url = env('WERTUGO_API').'/user/getusers';
        $response = Http::get($url);

        if ($response->successful()){
            $data = $response->json();

            return view('pages.daftar-user', ['users' => $data]);
        }
        return abort($response->status(), 'Gagal mengambil data dari server.');
    }
}
