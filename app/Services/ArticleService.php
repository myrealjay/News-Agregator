<?php

namespace App\Services;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ArticleService
{
    /**
     * Get articles by filter.
     *
     * @param ArticleRequest $request
     * @return LengthAwarePaginator
     */
    public function index(ArticleRequest $request) : LengthAwarePaginator
    {
        $perPage = $request->get('per_page', 50);
        $cacheKey = $this->buildCacheKey($request);
        $allCacheKeys = [];

        if (Cache::has('allkeys')) {
            $allCacheKeys = Cache::get('allkeys');
        }

        // if (in_array($cacheKey, $allCacheKeys)) {
        //     return Cache::get($cacheKey);
        // }

        //this key has not been cached before so fetch and cache.

        $articles = Article::filter($request)->paginate($perPage);

        // if (count($articles)) {
        //     Cache::put($cacheKey, $articles, now()->addDay());
        //     $allCacheKeys[] = $cacheKey;
        //     Cache::put('allkeys', $allCacheKeys);
        // }

        return $articles;
    }

    /**
     * Build cache key.
     *
     * @param ArticleRequest $request
     * @return string
     */
    protected function buildCacheKey(ArticleRequest $request) : string
    {
        $key = 'articles';
        $user = Auth::user();

        if ($request->has('category') && !empty($request->category)) {
            $key .= '_'. $request->category;
        }

        if ($request->has('date') && !empty($request->date)) {
            $key .= '_' . str_replace(['-', '/'], '', $request->date);
        }

        if ($request->has('source') && !empty($request->source)) {
            $key .= '_' . $request->source;
        }

        if ($request->has('per_page') && !empty($request->per_page)) {
            $key .= '_' . $request->per_page;
        }

        if ($request->has('page') && !empty($request->page)) {
            $key .= '_' . $request->page;
        }

        if ($user) {
            $key .= '_' .$user->id;
        }

        return $key;
    }

    /**
     * Get Article by ID.
     *
     * @param string $articleId
     * @return Article
     */
    public function show(string $articleId): ? Article
    {
        return Article::findOrFail($articleId);
    }
}
