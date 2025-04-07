<?php

namespace App\Http\Controllers;

use App\Models\Thread;
use App\Services\TrendingService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{


    public function dashboard(TrendingService $trendingService) {

        $user = Auth::user();

        $threads = Thread::all()->sortByDesc('created_at');


        return view("dashboard", [
            "user"=> $user,
            "trendings"=> $trendingService->getTrendingWords(),
            "threads"=> $threads
        ]);
    }


}
