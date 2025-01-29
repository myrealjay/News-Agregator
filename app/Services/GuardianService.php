<?php

namespace App\Services;

use App\Contracts\NewsProviderContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class GuardianService implements NewsProviderContract
{
    /**
     * @inheritDoc
     */
    public function fetchArticles(array $params = []): array
    {
        $baseUrl = trim(config('services.guardian.baseUrl'), '/');
        $apiKey = config('services.guardian.apiKey');

        $response = Http::get(
            "{$baseUrl}/search",
            array_merge($params, ['api-key' => $apiKey])
            )->json();

        return $response['response']['results'] ?? [];
    }

    /**
     * @inheritDoc
     */
    public function formatData(array $data): array
    {
        return [
            'title' => $data['webTitle'],
            'author' => $data['author'] ?? null,
            'description' => $data['description'] ?? null,
            'content' => $data['content'] ?? null,
            'source' => $data['webUrl'],
            'category' => $data['sectionName'],
            'image_url' => null,
            'url' => $data['webUrl'],
            'published_at' => Carbon::parse($data['webPublicationDate'])
        ];
    }
}
