<?php

namespace App\Helpers;

use App\Contracts\NewsProviderContract;
use App\Exceptions\InvalidSourceException;

class NewsProviderResolver
{
    /**
     * Resolves the strategy class.
     *
     * @param string $source
     * @throws InvalidSourceException
     * @return NewsProviderContract
     */
    public static function resolveNewsProvider(string $source) : NewsProviderContract
    {
        if (!in_array($source, config('aggregator.news_sources'))) {
            throw new InvalidSourceException("Unsopported news source: {$source}");
        }

        return app($source);
    }
}

