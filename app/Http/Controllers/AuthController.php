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

    }

    public function register(Request $request) {

    }

    public function trending(TrendingService $trendingService) {

        $trendingWords = $trendingService->getTrendingWords();


        return response()->json([
            'trending_words' => $trendingWords,
        ]);
    }


}
