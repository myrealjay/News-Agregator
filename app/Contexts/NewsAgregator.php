<?php

namespace App\Contexts;

use App\Contracts\NewsProviderContract;
use App\Helpers\NewsProviderResolver;

class NewsAgregator implements NewsProviderContract
{
    /**
     * The news provider.
     * @var NewsProviderContract
     */
    private NewsProviderContract $newsProvider;

    /**
     * Filters to be applied.
     * @var array
     */
    private array $filters = [];

    public function __construct(string $source)
    {
        $this->newsProvider = NewsProviderResolver::resolveNewsProvider($source);
        $this->filters = config('aggregator.query_parameters');
    }

    /**
     * Fetch articles from selected provider.
     *
     * @return array
     */
    public function fetchArticles(array $params = []): array
    {
        if (count($params)) $this->filters = $params;
        return $this->newsProvider->fetchArticles($this->filters);
    }

    /**
     * Summary of formatData
     * @param array $data
     * @return array
     */
    public function formatData(array $data): array
    {
        return $this->newsProvider->formatData($data);
    }

    /**
     * @inheritDoc
     */
    public function hasNext(): bool
    {
        return $this->newsProvider->hasNext();
    }
}
