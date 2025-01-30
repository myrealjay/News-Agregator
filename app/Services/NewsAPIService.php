<?php

namespace App\Services;

use App\Contracts\NewsProviderContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class NewsAPIService implements NewsProviderContract
{
    /**
     * @inheritDoc
     */
    public function fetchArticles(array $params = []): array
    {
        $baseUrl = trim(config('services.newsapi.baseUrl'), '/');
        $apiKey = config('services.newsapi.apiKey');

        try {
            $response = Http::get(
            "{$baseUrl}/v2/everything",
            array_merge($params, ['apiKey' => $apiKey])
            )->json();
        } catch(\Exception $exception) {
            Log::error($exception);
            return [];
        }

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
            'published_at' => Carbon::parse($data['publishedAt'])->format('Y-m-d H:i:s')
        ];
    }
}
