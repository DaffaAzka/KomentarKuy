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
    // Task 1: Validasi input
    $request->validate([
        'content' => 'required|string|max:255',
    ]);

    // Task 2: Temukan comment berdasarkan ID
    $comment = Comment::find($id);

    // Jika comment tidak ditemukan
    if (!$comment) {
        return redirect()->back()->with('error', 'Comment not found.');
    }

    // Task 3: Perbarui konten comment
    $comment->content = $request->input('content');

    // Task 4: Simpan perubahan ke database
    $saved = $comment->save();

    // Task 5 & 8: Jika berhasil, redirect ke halaman thread asal
    if ($saved) {
        return redirect()->route('thread.show', ['id' => $comment->thread_id])
                         ->with('success', 'Comment edited successfully.');
    }

    // Jika gagal menyimpan
    return redirect()->route('thread.show', ['id' => $comment->thread_id])
                     ->with('error', 'Failed to update comment.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Task 1: Temukan comment berdasarkan ID
    $comment = Comment::find($id);

    // Jika comment tidak ditemukan, redirect balik
    if (!$comment) {
        return redirect()->back()->with('error', 'Comment not found.');
    }

    // Task 4: Simpan ID thread sebelum comment dihapus
    $threadId = $comment->thread_id;

    // Task 2: Hapus comment dari database
    $deleted = $comment->delete();

    // Task 3: Cek jika berhasil dihapus
    if ($deleted) {
        return redirect()->route('thread.show', ['id' => $threadId])
                         ->with('success', 'Comment deleted successfully.');
    }

    // Jika gagal menghapus
    return redirect()->route('thread.show', ['id' => $threadId])
                     ->with('error', 'Failed to delete comment.');
}
}
