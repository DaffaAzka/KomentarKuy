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
        /**
         * Task 1: Validasi input ($request->validate)
         * Task 2: Temukan thread berdasarkan ID (Thread::find)
         * Task 3: Perbarui konten thread dengan input dari form ($request->content)
         * Task 4: Simpan perubahan ke database
         * Task 5: Ubah if di line 108 menjadi if(jika data berhasil disimpan)
         *
         * Struktur database:
         * - id (tidak perlu untuk update dan delete)
         * - user_id (tidak perlu untuk update dan delete)
         * - content
         *
         * PS: Referensi ada di function store
        */

        if(true) {
            return redirect()->route('dashboard')->with('success', 'Thread edited successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /**
         * Task 1: Temukan thread berdasarkan ID (Thread::find)
         * Task 2: Hapus thread dari database
         * Task 3: Ubah if di line 131 menjadi if(jika data berhasil dihapus)
         *
         * Struktur database:
         * - id (tidak perlu untuk update dan delete)
         * - user_id (tidak perlu untuk update dan delete)
         * - content (tidak perlu untuk delete)
         *
         * PS: Referensi ada di function store
        */

        if(true) {
            return redirect()->route('dashboard')->with('success', 'Thread deleted successfully.');
        }
    }
}
