<?php

namespace App\Traits;

use App\Http\Requests\ArticleRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

trait HasArticleFilter
{
    /**
     * Filters articles based on request parameters.
     *
     * @param Builder $query
     * @param ArticleRequest $request
     *
     * @return Builder
     */
    public function scopeFilter(Builder $query, ArticleRequest $request): builder
    {
        $query = $query->when($request->has("search") && !empty($request->search),
        function($query) use ($request, &$cacheKey) {
            $cacheKey.= "_".str_replace(' ','', $request->search);
            return $query->where('title', 'LIKE', "%{$request->search}%")
            ->orWhere('description', 'LIKE', "%{$request->search}%")
            ->orWhere('description', 'LIKE', "%{$request->search}%");
        })
        ->when($request->has('category') && !empty($request->category), function($query) use($request) {
            return $query->where('category', $request->category);
        })
        ->when($request->has('source') && !empty($request->source), function($query) use($request) {
            return $query->where('source', $request->source);
        })
        ->when($request->has('author') && !empty($request->author), function($query) use($request) {
            return $query->where('author', $request->author);
        })
        ->when($request->has('date') && !empty($request->date), function($query) use($request) {
            return $query->whereDate('published_at', Carbon::parse($request->date)->format('Y-m-d'));
        })
        ->when($request->has('start_date') && $request->has('end_date'), function($query) use($request) {
            return $query->whereBetween(
                'published_at',
                [Carbon::parse($request->start_date)->format('Y-m-d'), Carbon::parse($request->end_date)->format('Y-m-d')]
            );
        });

        return $this->getUserPreferences($query, $request);
    }

    /**
     * Check for user preferences before returning result.
     *
     * @param Builder $query
     * @param ArticleRequest $request
     * @return Builder
     */
    public function getUserPreferences(Builder $query, Articlerequest $request): Builder
    {
        $user = Auth::user();

        if (!$user) return $query;

        $preferences = $user->preferences;

        if (!$preferences) return $query;

        $query->when($preferences->categories && empty($request->category ?? null),
        function($query) use($preferences, $request) {
            return $query->whereIn('category', $preferences->categories);
        })
        ->when($preferences->sources && empty($request->source ?? null),
        function($query) use ($preferences, $request) {
            return $query->whereIn('source', $preferences->sources);
        })
        ->when($preferences->authors && empty($request->author ?? null),
        function($query) use ($preferences, $request) {
            return $query->whereIn('author', $preferences->authors);
        });

        return $query;
    }
}
