<?php

namespace App\Contexts;

use App\Contracts\NewsProviderContract;

class NewsAgregator
{
    private NewsProviderContract $newsProvider;

    public function __construct(NewsProviderContract $newsProvider)
    {
        $this->newsProvider = $newsProvider;
    }

    /**
     * Fetch articles from selected provider.
     *
     * @param array $filters
     * @return array
     */
    public function fetchArticles(array $filters = []): array
    {
        return $this->newsProvider->fetchArticles($filters);
    }
}
