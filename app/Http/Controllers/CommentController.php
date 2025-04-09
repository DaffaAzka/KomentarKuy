<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Services\TrendingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
            'thread_id' => 'required|exists:threads,id',
        ]);

        Comment::create([
            'user_id' => $request->user()->id,
            'thread_id' => $request->input('thread_id'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('thread.show', ['id' => $request->input('thread_id')])->with('success', 'Comment created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, TrendingService $trendingService)
    {
        $user = Auth::user();

        $comment = Comment::find($id);

        if (!$comment) {
            return abort(404);
        }

        return view("comment.edit", [
            "user"=> $user,
            "trendings"=> $trendingService->getTrendingWords(),
            "comment"=> $comment
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /**
         * Task 1: Validasi input ($request->validate) Task 1: Validasi input ($request->validate)
         * Task 2: Temukan comment berdasarkan ID (Comment::find)
         * Task 3: Perbarui konten comment dengan input dari form ($request->content)
         * Task 4: Simpan perubahan ke database
         * Task 5: Ubah if di line 95 menjadi if(jika data berhasil disimpan)
         * Task 8: Redirect ke halaman thread dengan ID yang sesuai ($comment->thread_id)
         *
         * Struktur database:
         * - id (tidak perlu untuk update dan delete)
         * - user_id (tidak perlu untuk update dan delete)
         * - thread_id (tidak perlu untuk update dan delete)
         * - content
         *
         * PS: Referensi ada di function store
        */

        if(true) {
            return redirect()->route('thread.show', ['id' => 0])->with('success', 'Comment edited successfully.');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        /**
         * Task 1: Temukan comment berdasarkan ID (Comment::find)
         * Task 2: Hapus comment dari database
         * Task 3: Ubah if di line 121 menjadi if(jika data berhasil dihapus)
         * Task 4: Redirect ke halaman thread dengan ID yang sesuai (hint -> simpan ID Thread sebelum comment dihapus)
         *
         * Struktur database:
         * - id (tidak perlu untuk update dan delete)
         * - user_id (tidak perlu untuk update dan delete)
         * - thread_id (tidak perlu untuk update dan delete)
         * - content (tidak perlu untuk delete)
         *
         * PS: Referensi ada di function store
        */

        if(true) {
            return redirect()->route('thread.show', ['id' => 0])->with('success', 'Comment deleted successfully.');
        }
    }
}
