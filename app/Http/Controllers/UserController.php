<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator; // Jangan lupa import ini!

class UserController extends Controller
{
    public function index(Request $request)
    {
        // 1. Tangkap halaman saat ini (default: 1)
        $page = $request->input('page', 1);

        $url = env('WERTUGO_API').'/user/getusers';
        
        // 2. Kirim parameter page ke API
        $response = Http::get($url, ['page' => $page]);

        if ($response->successful()){
            $apiData = $response->json();

            // 3. Bangun Paginator
            // Pastikan struktur response API kamu benar-benar dari fungsi ->paginate() 
            // sehingga memiliki key 'data', 'total', dll.
            $users = new LengthAwarePaginator(
                $apiData['data'],           
                $apiData['total'],          
                $apiData['per_page'],       
                $apiData['current_page'],   
                [
                    'path' => $request->url(), 
                    'query' => $request->query()
                ]
            );

    //       dd([
        //     '1_total_semua_data' => $users->total(),
        //     '2_data_per_halaman' => $users->perPage(),
        //     '3_total_halaman' => $users->lastPage(),
        //     '4_apakah_ada_halaman_berikutnya' => $users->hasMorePages()
    //      ]);

            return view('pages.daftar-user', [
                'users' => $users,
                'tableHeaders' => ['User Profile', 'Role', 'Status', 'Join Date', 'Aksi'] // Saya ganti 'Action' ke 'Aksi' agar pas dengan Blade-mu
            ]);
        }
        
        return abort($response->status(), 'Gagal mengambil data dari server.');
    }
}