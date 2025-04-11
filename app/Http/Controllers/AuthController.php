<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Models\User;
use App\Services\TrendingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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

    public function editProfile(Request $request) {


        $user = Auth::user();
        $image = null;
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
        ]);


        if (User::where('username', $request->username)->exists() && $user->username != $request->username) {
            return redirect()->back()->withErrors(['error'=> "Username already exists"]);
        }

        // $temp = User::find($user->id);

        if ($request->image) {
            $fileName = $this->generateRandomString();
            $extension = $request->image->extension();
            $image = $fileName . '.' . $extension;
            Storage::disk('public')->putFileAs('images', $request->image, $image);
        }

        User::where('id', $user->id)->update([
            'name' => $request->name,
            'username' => $request->username,
            'profile_picture' => $image,
        ]);

        return redirect()->back()->with('success', 'Profile updated successfully');

    }

    function generateRandomString($length = 30): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }


}
