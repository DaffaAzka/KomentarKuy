<?php

namespace App\Services;

use App\Models\Thread;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class TrendingService {

    public function getTrendingWords(int $limit = 5) {
        return Cache::remember('trending-words', now()->addHours(6), function () use ($limit) {

            $threads = Thread::latest()->take(100)->get('content');
            $wordCounts = [];

            foreach ($threads as $thread) {

                $text = Str::lower($thread->content);

                $words = str_word_count($text, 1);

                foreach ($words as $word) {
                    if (strlen($word) > 3 && !in_array($word, ['yang', 'dan', 'di', 'untuk'])) {
                        $wordCounts[$word] = ($wordCounts[$word] ?? 0) + 1;
                    }
                }

            }

            arsort($wordCounts);

            return array_slice($wordCounts, 0, $limit, true);

        });
    }

}

