<?php

namespace Tests\Feature;

use App\Services\NewsAPIService;
use Illuminate\Support\Facades\Http;
use Tests\Feature\Traits\HasNewsAPIResponse;
use Tests\TestCase;

class NewsApiServiceTest extends TestCase
{
    use HasNewsAPIResponse;

    /**
     * test that the NewsAPIService can make api calls to news PAI and return response.
     *
     * @test
     */
    public function it_makes_api_calls_correctly_and_returns_response(): void
    {
        $data = $this->getApiResponse();
        Http::fake([
            'https://newsapi.org/*' => Http::response($data, 200)
        ]);

        $newApiService = new NewsAPIService();
        $response = $newApiService->fetchArticles(['q' => 'technology OR fashion']);

        $this->assertCount(2, $response);

        $this->assertEquals($response[0]['source']['name'], $data['articles'][0]['source']['name']);
    }

}
