<?php

namespace Tests\Feature;

use App\Services\GuardianService;
use Illuminate\Support\Facades\Http;
use Tests\Feature\Traits\HasGuardianresponse;
use Tests\TestCase;

class GuardianServiceTest extends TestCase
{
    use HasGuardianresponse;

    /**
     * test that the GuardianService can make api calls to Guardian API and return response.
     *
     * @test
     */
    public function it_makes_api_calls_correctly_and_returns_response(): void
    {
        $data = $this->getApiResponse();
        Http::fake([
            'https://content.guardianapis.com/*' => Http::response($data, 200)
        ]);

        $guardianService = new GuardianService();
        $response = $guardianService->fetchArticles(['q' => 'technology OR fashion']);

        $this->assertCount(2, $response);

        $this->assertEquals($response[0]['sectionName'], $data['response']['results'][0]['sectionName']);
    }
}
