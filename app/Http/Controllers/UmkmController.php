<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class UmkmController extends Controller
{
    public function index(Request $request){
         // 1. Tangkap halaman saat ini (default: 1)
        $page = $request->input('page', 1);

        $url = env('WERTUGO_API').'/umkm/getumkm';
        
        // 2. Kirim parameter page ke API
        $response = Http::get($url, ['page' => $page]);

        if ($response->successful()){
            $apiData = $response->json();

            // 3. Bangun Paginator
            // Pastikan struktur response API kamu benar-benar dari fungsi ->paginate() 
            // sehingga memiliki key 'data', 'total', dll.
            $umkm = new LengthAwarePaginator(
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

            return view('pages.daftar-umkm', [
                'umkm' => $umkm,
                'tableHeaders' => ['Profil UMKM', 'Status Aktif', 'Status Verifikasi', 'Join Date', 'Aksi'] // Saya ganti 'Action' ke 'Aksi' agar pas dengan Blade-mu
            ]);
        }
        
        return abort($response->status(), 'Gagal mengambil data dari server.');
    }
}
