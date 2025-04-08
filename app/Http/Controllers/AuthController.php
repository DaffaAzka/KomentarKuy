<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\User;
use App\Services\TrendingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        $validated=$request->validate([
            'name'=> 'required|string|max:255',
            'username'=>'required|string|max:255',
            'email'=>'required|email',
            'password'=>'required|min:6',
            'password_confirmation'=>'required|min:6',
         ]);

        if (User::where('email', $validated['email'])->exists()) {
            return redirect()->back()->withErrors(['error' => 'Email already exists']);
        }

        if (User::where('username', $validated['username'])->exists()) {
            return redirect()->back()->withErrors(['error' => 'Username already exists']);
        }

        if ($validated['password'] !== $validated['password_confirmation']) {
            return redirect()->back()->withErrors(['error' => 'Passwords do not match']);
        }

        User::create([
            'name' => $validated['name'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        return redirect()->route('auth.login');

    }

    public function trending(TrendingService $trendingService) {

        // $trendingWords = $trendingService->getTrendingWords();


        // return response()->json([
        //     'trending_words' => $trendingWords,
        // ]);
    }


}
