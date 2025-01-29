<?php

namespace Tests\Feature;

use App\Services\NYTimesService;
use Illuminate\Support\Facades\Http;
use Tests\Feature\Traits\HasNYTimesResponse;
use Tests\TestCase;

class MYTimesServiceTest extends TestCase
{
    use HasNYTimesResponse;

    /**
     * Test that the MYTimesService can make api calls to new york times API and return response.
     *
     * @test
     */
    public function it_makes_api_calls_correctly_and_returns_response(): void
    {
        $data = $this->getApiResponse();
        Http::fake([
            'https://api.nytimes.com/*' => Http::response($data, 200)
        ]);

        $newApiService = new NYTimesService();
        $response = $newApiService->fetchArticles(['q' => 'technology OR fashion']);

        $this->assertCount(1, $response);

        $this->assertEquals($response[0]['title'], $data['results'][0]['title']);
    }
}
