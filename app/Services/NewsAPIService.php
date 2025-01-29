<?php

namespace App\Services;

use App\Contracts\NewsProviderContract;
use Illuminate\Support\Facades\Http;

class NewsAPIService implements NewsProviderContract
{
    /**
     * @inheritDoc
     */
    public function fetchArticles(array $params = []): array
    {
        $baseUrl = trim(config('services.newsapi.baseUrl'), '/');
        $apiKey = config('services.newsapi.apiKey');

        $response = Http::get(
            "{$baseUrl}/v2/everything",
            array_merge($params, ['apiKey' => $apiKey])
            )->json();

        return $response['articles'] ?? [];
    }

    /**
     * @inheritDoc
     */
    public function formatData(array $data): array
    {
        return [
            'title' => $data['title'],
            'author' => $data['author'],
            'description' => $data['description'],
            'content' => $data['content'],
            'source' => $data['source']['name'],
            'category' => $data['category'] ?? 'General',
            'image_url' => $data['urlToImage'],
            'url' => $data['url'],
            'published_at' => $data['publishedAt']
        ];
    }
}
