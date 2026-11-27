<?php

namespace Innoboxrr\LivewireComments\Http\Controllers;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    
    /**
     * blockId y userId llegan en la ruta. Antes se validaban como entrada de
     * la peticion, donde no estan, y la validacion fallaba siempre.
     */
    public function index(Request $request, $blockId, $userId)
    {
        $cacheKey = "comments_{$blockId}_{$userId}";
        $comments = Cache::remember($cacheKey, 1, function () use ($blockId, $userId) {
            $response = Http::get(config('lwc.base_url') . "/api/get-comments/{$blockId}/{$userId}");
            return $response->successful() ? $response->json() : [];
        });

        return view('lwc::comments', ['comments' => $comments ?? []]);
    }

    public function blockIndex(Request $request, $blockId)
    {
        $cacheKey = "block_comments_{$blockId}";
        $comments = Cache::remember($cacheKey, 1, function () use ($blockId) {
            $response = Http::get(config('lwc.base_url') . "/api/comments/filter/content/{$blockId}");
            return $response->successful() ? $response->json() : [];
        });

        return view('lwc::comments', ['comments' => $comments ?? []]);
    }

    public function userIndex(Request $request, $userId)
    {
        $cacheKey = "user_comments_{$userId}";
        $comments = Cache::remember($cacheKey, 1, function () use ($userId) {
            $response = Http::get(config('lwc.base_url') . "/api/comments/filter/user/{$userId}");
            return $response->successful() ? $response->json() : [];
        });

        return view('lwc::comments', ['comments' => $comments ?? []]);
    }

}
