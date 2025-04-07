<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Services\TrendingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request) {
        $credential = $request->validate([
            "email"=> "required|email",
            "password"=> "required",
        ]);

        if (Auth::attempt($credential)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid credentials']);
        }
    }


    public function logout(Request $request) {


        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }

    public function register(Request $request) {
        /**
         * Task 1: Validasi inputan register
         * Task 2: Cek apakah email sudah digunakan atau belum
         * Task 3: Cek apakah password dan konfirmasi password sama
         * Task 4: Simpan data user ke database
         * Task 6: Redirect ke halaman login
         * Task 7: Jika gagal, tampilkan pesan error (contoh redirectnya ada di function login)
         *
         * Struktur request dari form:
         * - name
         * - username
         * - email
         * - password
         * - password_confirmation
         *
         * Struktur database:
         * - name
         * - username
         * - email
         * - password
         *
         * PS: Referensi ada di function store
         */

         return redirect()->route('auth.login');
    }

    public function trending(TrendingService $trendingService) {

        $trendingWords = $trendingService->getTrendingWords();


        return response()->json([
            'trending_words' => $trendingWords,
        ]);
    }


}
