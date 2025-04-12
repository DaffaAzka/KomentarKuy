<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Services\TrendingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThreadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);
        $thread = Thread::create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
        ]);

        $thread->save();

        return redirect()->route('dashboard')->with('success', 'Thread created successfully.');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, TrendingService $trendingService)
    {
        $user = Auth::user();

        $thread = Thread::find($id);

        if (!$thread) {
            return abort(404);
        }

        return view("threads.show", [
            "user"=> $user,
            "trendings"=> $trendingService->getTrendingWords(),
            "thread"=> $thread
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, TrendingService $trendingService)
    {
        $user = Auth::user();

        $thread = Thread::find($id);

        if (!$thread) {
            return abort(404);
        }

        return view("threads.edit", [
            "user"=> $user,
            "trendings"=> $trendingService->getTrendingWords(),
            "thread"=> $thread
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       // Validasi input untuk memastikan 'content' sesuai aturan
    $request->validate([
        'content' => 'required|string|max:255',
    ]);

    // Cari thread berdasarkan ID
    $thread = Thread::find($id);

    // Jika thread tidak ditemukan, kembalikan pesan error
    if (!$thread) {
        return redirect()->route('dashboard')->with('error', 'Thread not found.');
    }

    // Perbarui konten thread
    $thread->content = $request->input('content');

    // Simpan perubahan ke database
    if ($thread->save()) {
        // Jika berhasil, tampilkan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Thread updated successfully.');
    }

    // Jika gagal, tampilkan pesan error
    return redirect()->route('dashboard')->with('error', 'Failed to update thread.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
     // Cari thread berdasarkan ID
    $thread = Thread::find($id);

    // Jika thread tidak ditemukan, kembalikan pesan error
    if (!$thread) {
        return redirect()->route('dashboard')->with('error', 'Thread not found.');
    }

    // Hapus thread dari database
    if ($thread->delete()) {
        // Jika berhasil, tampilkan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Thread deleted successfully.');
    }

    // Jika gagal, tampilkan pesan error
    return redirect()->route('dashboard')->with('error', 'Failed to delete thread.');
    }
}
