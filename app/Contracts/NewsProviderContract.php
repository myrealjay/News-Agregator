<?php

namespace App\Contracts;

interface NewsProviderContract
{
    /**
     * Fetches Articles from given source using providers parameters.
     *
     * @param array $params
     *
     * @return array
     */
    public function fetchArticles(array $params = []) : array;

    /**
     * Fromata the data in a way that can be easily saved to database.
     *
     * @param array $data
     *
     * @return void
     */
    public function formatData(array $data): array;
}
