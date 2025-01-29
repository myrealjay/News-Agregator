<?php

namespace Tests\Feature\services;

use App\Services\NYTimesService;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Traits\HasApiResponse;
use Tests\TestCase;

class MYTimesServiceTest extends TestCase
{
    use HasApiResponse;

    #[Test]
    public function it_makes_api_calls_correctly_and_returns_response(): void
    {
        $data = $this->getApiResponse('nytimes');
        Http::fake([
            'https://api.nytimes.com/*' => Http::response($data, 200)
        ]);

        $newApiService = new NYTimesService();
        $response = $newApiService->fetchArticles(['q' => 'technology OR fashion']);

        $this->assertCount(1, $response);

        $this->assertEquals($response[0]['title'], $data['results'][0]['title']);
    }
}
