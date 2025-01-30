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
        $query = $query->when($request->filled("search"),
        function($query) use ($request) {
            return $query->where('title', 'LIKE', "%{$request->search}%")
            ->orWhere('description', 'LIKE', "%{$request->search}%")
            ->orWhere('content', 'LIKE', "%{$request->search}%");
        })
        ->when($request->filled('category'), function($query) use($request) {
            return $query->where('category', $request->category);
        })
        ->when($request->filled('source'), function($query) use($request) {
            return $query->where('source', $request->source);
        })
        ->when($request->filled('author'), function($query) use($request) {
            return $query->where('author', $request->author);
        })
        ->when($request->filled('date'), function($query) use($request) {
            return $query->whereDate('published_at', Carbon::parse($request->date)->format('Y-m-d'));
        })
        ->when($request->filled('start_date') && $request->filled('end_date'),
        function($query) use($request) {
            return $query->whereBetween(
                'published_at',
                [
                    Carbon::parse($request->start_date)->format('Y-m-d'),
                    Carbon::parse($request->end_date)->format('Y-m-d')
                    ]
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

        //Fetch by user preferences if the user is not specifically filtering for
        //categories, sources and authors
        $query->when($preferences->categories && !$request->filled('category'),
        function($query) use($preferences, $request) {
            return $query->whereIn('category', $preferences->categories);
        })
        ->when($preferences->sources && !$request->filled('source'),
        function($query) use ($preferences, $request) {
            return $query->whereIn('source', $preferences->sources);
        })
        ->when($preferences->authors && !$request->filled('author'),
        function($query) use ($preferences, $request) {
            return $query->whereIn('author', $preferences->authors);
        });

        return $query;
    }
}
