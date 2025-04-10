<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Like;
use App\Models\Thread;
use App\Models\User;
use App\Services\TrendingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{


    public function dashboard(TrendingService $trendingService, $word = '') {

        $user = Auth::user();

        $threads = Thread::where('content', 'LIKE', "%{$word}%")
            ->orderByDesc('created_at')
            ->get();

        return view("dashboard", [
            "user"=> $user,
            "trendings"=> $trendingService->getTrendingWords(),
            "threads"=> $threads
        ]);
    }

    public function profile($username = '') {
        $user = Auth::user();

        if ($username == '') {
            $profile = $user;
        } else {
            $profile = User::where('username', $username)->first();
        }


        // $threads = Thread::where("user_id", "LIKE", "%{$user->id}%")
        //     ->orderByDesc('created_at')
        //     ->get();

            // dd($profile);

        return view('profile', [
            'user'=> $user,
            'profile'=> $profile
        ]);
    }
    public function creators() {
        $user = Auth::user();
        return view('creators', [
            'user'=> $user
        ]);
    }

    public function trending(TrendingService $trendingService) {
        $user = Auth::user();

        return view('trending', [
            "user"=> $user,
            "trendings"=> $trendingService->getTrendingWords(),
        ]);
    }

    public function like(Request $request) {
        $user = Auth::user();

        if($request->input('thread_id') == null) {
            $comment = Comment::find($request->input('comment_id'));

            $like = $comment->likes()->where('user_id', $user->id)->first();

            if ($like) {
                $like->delete();
            } else {
                Like::create([
                    'user_id' => $user->id,
                    'comment_id' => $comment->id,
                ]);
            }
        } else {
            $thread = Thread::find($request->input('thread_id'));

            $like = $thread->likes()->where('user_id', $user->id)->first();

            if ($like) {
                $like->delete();
            } else {
                Like::create([
                    'user_id' => $user->id,
                    'thread_id' => $thread->id,
                ]);
            }
        }


        return redirect()->back();
    }


}
