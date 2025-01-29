<?php

namespace App\Services;

use App\Contracts\NewsProviderContract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;

class NYTimesService implements NewsProviderContract
{
    /**
     * @inheritDoc
     */
    public function fetchArticles(array $params = []): array
    {
        $params = [];
        $baseUrl = trim(config('services.nytimes.baseUrl'), '/');
        $apiKey = config('services.nytimes.apiKey');

        $response = Http::get(
            "{$baseUrl}/svc/topstories/v2/home.json",
            array_merge($params, ['apiKey' => $apiKey])
            )->json();

        return $response['results'] ?? [];
    }

    /**
     * @inheritDoc
     */
    public function formatData(array $data): array
    {
        return [
            'title' => $data['title'],
            'author' => $data['byline'],
            'description' => implode(',', $data['des_facet']),
            'content' => $data['abstract'],
            'source' => implode(',', $data['org_facet']),
            'category' => $data['item_type'],
            'image_url' => $this->getImageUrl($data['multimedia']),
            'url' => $data['url'],
            'published_at' => Carbon::parse($data['published_date'])
        ];
    }

    /**
     * Extract Image url.
     *
     * @param array $multimedia
     *
     * @return string|null
     */
    protected function getImageUrl(array $multimedia) : ?string
    {
        $imageItem = collect($multimedia)->filter(function($item) {
            return $item['type'] === 'image';
        })->first();

        return $imageItem ? $imageItem['url'] : null;
    }
}
