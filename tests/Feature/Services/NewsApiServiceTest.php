<?php

namespace Tests\Feature\Services;

use App\Services\NewsAPIService;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Traits\HasApiResponse;
use Tests\TestCase;

class NewsApiServiceTest extends TestCase
{
    use HasApiResponse;

    #[Test]
    public function it_makes_api_calls_correctly_and_returns_response(): void
    {
        $data = $this->getApiResponse('newsapi');
        Http::fake([
            'https://newsapi.org/*' => Http::response($data, 200)
        ]);

        $newApiService = new NewsAPIService();
        $response = $newApiService->fetchArticles(['q' => 'technology OR fashion']);

        $this->assertCount(2, $response);

        $this->assertEquals($response[0]['source']['name'], $data['articles'][0]['source']['name']);
    }

}
