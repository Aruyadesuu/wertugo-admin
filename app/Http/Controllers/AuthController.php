<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    public function showLogin(){
        return view('pages.auth.login');
    }

    public function login(Request $request){
        $request->validate([
           'email' => 'required|email',
           'password' => 'required' 
        ]);

        $response = Http::acceptJson()->post(env('WERTUGO_API').'/login', [
            'email' => $request->email,
            'password' => $request->password
        ]);

        if($response->successful()) {
            $data = $response->json();
            
            if(isset($data['user']) && $data['user']['role'] === 'admin'){
                Session::put('api_token', $data['access_token']);
                Session::put('user_data', $data['user']);

                return redirect('/admin')->with('success', 'Berhasil Login sebagai Admin');
            } else {
                if(isset($data['access_token'])) {
                    Http::withToken($data['access_token'])->post(env('WERTUGO_API').'/logout');
                }
                return back()->withErrors(['email' => 'Anda bukan Admin.']);
            }
        }
        
        // dd('Status:', $response->status(), 'Balasan JSON:', $response->json());

        return back()->withErrors(['email' => 'Email atau Password salah!']);
    }
    public function logout(){
        $token = Session::get('api_token');

        if($token) {
            Http::withToken($token)->post(env('WERTUGO_API').'/logout');
        }

        Session::flush();

        return redirect('login')->with('success', 'Berhasil logout');;
    }
}
