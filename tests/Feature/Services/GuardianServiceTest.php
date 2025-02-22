<?php

namespace Tests\Feature\Services;

use App\Services\GuardianService;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\Attributes\Test;
use Tests\Feature\Traits\HasApiResponse;
use Tests\TestCase;

class GuardianServiceTest extends TestCase
{
    use HasApiResponse;

    #[Test]
    public function it_makes_api_calls_correctly_and_returns_response(): void
    {
        $data = $this->getApiResponse('guardian');
        Http::fake([
            'https://content.guardianapis.com/*' => Http::response($data, 200)
        ]);

        $guardianService = new GuardianService();
        $response = $guardianService->fetchArticles(['q' => 'technology OR fashion']);

        $this->assertCount(2, $response);

        $this->assertEquals($response[0]['sectionName'], $data['response']['results'][0]['sectionName']);
    }
}
