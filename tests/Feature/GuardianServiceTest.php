<?php

namespace Tests\Feature;

use App\Services\GuardianService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class GuardianServiceTest extends TestCase
{
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

    /**
     * Get the data returned from API call.
     *
     * @return array
     */
    protected function getApiResponse(): array
    {
        return [
            "response"=> [
                "status"=> "ok",
                "userTier"=> "developer",
                "total"=> 54320,
                "startIndex"=> 1,
                "pageSize"=> 10,
                "currentPage"=> 1,
                "pages"=> 5432,
                "orderBy"=> "relevance",
                "results"=> [
                    [
                        "id"=> "business/nils-pratley-on-finance/2025/jan/28/the-stock-market-is-always-terrible-at-valuing-technology-revolutions",
                        "type"=> "article",
                        "sectionId"=> "business",
                        "sectionName"=> "Business",
                        "webPublicationDate"=> "2025-01-28T18=>10=>43Z",
                        "webTitle"=> "The stock market is always terrible at valuing technology revolutions",
                        "webUrl"=> "https=>//www.theguardian.com/business/nils-pratley-on-finance/2025/jan/28/the-stock-market-is-always-terrible-at-valuing-technology-revolutions",
                        "apiUrl"=> "https=>//content.guardianapis.com/business/nils-pratley-on-finance/2025/jan/28/the-stock-market-is-always-terrible-at-valuing-technology-revolutions",
                        "isHosted"=> false,
                        "pillarId"=> "pillar/news",
                        "pillarName"=> "News"
                    ],
                    [
                        "id"=> "fashion/2025/jan/05/rosita-missoni-obituary",
                        "type"=> "article",
                        "sectionId"=> "fashion",
                        "sectionName"=> "Fashion",
                        "webPublicationDate"=> "2025-01-05T17=>52=>27Z",
                        "webTitle"=> "Rosita Missoni obituary",
                        "webUrl"=> "https=>//www.theguardian.com/fashion/2025/jan/05/rosita-missoni-obituary",
                        "apiUrl"=> "https=>//content.guardianapis.com/fashion/2025/jan/05/rosita-missoni-obituary",
                        "isHosted"=> false,
                        "pillarId"=> "pillar/lifestyle",
                        "pillarName"=> "Lifestyle"
                    ]
                ]
            ]
        ];
    }
}
