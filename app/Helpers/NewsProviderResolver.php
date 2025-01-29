<?php

namespace App\Helpers;

use App\Contracts\NewsProviderContract;
use App\Exceptions\InvalidStrategyException;


class NewsProviderResolver
{
    /**
     * Resolves the strategy class.
     *
     * @param string $strategy
     * @throws InvalidStrategyException
     * @return NewsProviderContract
     */
    public static function resolveNewsProvider(string $strategy) : NewsProviderContract
    {
        if (!in_array($strategy, config('aggregator.strategies'))) {
            throw new InvalidStrategyException("Unsopported news strategy: {$strategy}");
        }

        return app($strategy);
    }
}

