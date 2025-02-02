<?php

namespace App\Services;

use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GuardianService extends NewsServiceBase
{
    /**
     * @inheritDoc
     */
    public function fetchArticles(array $params = []): array
    {
        if (!$this->isInitialRequest) $this->page += 1;
        $baseUrl = trim(config('services.guardian.baseUrl'), '/');
        $apiKey = config('services.guardian.apiKey');

        try {
            $response = Http::get(
            "{$baseUrl}/search",
            array_merge($params, ['api-key' => $apiKey, 'page' => $this->page])
            )->json();
        } catch(\Exception $exception) {
            Log::error($exception);
            $this->isInitialRequest = false;
            $this->hasData = false;
            return [];
        }

        $this->isInitialRequest = false;

        $data = $response['response']['results'] ?? [];
        $this->hasData = count($data) > 0;

        return $data;
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
            'published_at' => Carbon::parse($data['webPublicationDate'])->format('Y-m-d H:i:s')
        ];
    }
}
