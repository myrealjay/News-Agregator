<?php

namespace Tests\Feature;

use App\Services\NewsAPIService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class NewsApiServiceTest extends TestCase
{
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

    /**
     * Get the data returned from API call.
     *
     * @return array
     */
    protected function getApiResponse(): array
    {
        return [
                "status"=> "ok",
                "totalResults"=> 70025,
                "articles"=> [
                    [
                        "source"=> [
                            "id"=> "wired",
                            "name"=> "Wired"
                        ],
                        "author"=> "Vittoria Elliott",
                        "title"=> "Gold Sneakers and Too-Tight Suits=> The Menswear Guy Weighs In on Inauguration Weekend",
                        "description"=> "Menswear influencer Derek Guy is unimpressed by what tech barons and the MAGA rank and file wore this weekend. “To be frank,” he says, “many conservatives are often behind on fashion trends.”",
                        "url"=> "https=>//www.wired.com/story/menswear-guy-maga-tight-suits-gold-sneakers/",
                        "urlToImage"=> "https=>//media.wired.com/photos/678eb4eae2eb3c757494ed1c/191=>100/w_1280,c_limit/maga-fashion-pol.jpg",
                        "publishedAt"=> "2025-01-21T12=>00=>00Z",
                        "content"=> "Do you think that sort of classic American lookthe Ralph Lauren, the Oxford shirtis that going to be sort of the purview of MAGA forever or do you see that changing?\r\nI don't think the classic Americ… [+3749 chars]"
                    ],
                    [
                        "source"=> [
                            "id"=> null,
                            "name"=> "Gizmodo.com"
                        ],
                        "author"=> "Sabina Graves",
                        "title"=> "Nightmare Before Christmas Merchandise Is Coming to Take Over Your Other Holidays, Too",
                        "description"=> "The Halloween and Christmas collision takes over every season in our exclusive look at Loungefly's latest fandom fashion collection.",
                        "url"=> "https=>//gizmodo.com/loungefly-nightmare-before-christmas-zero-collection-valentines-day-2000550360",
                        "urlToImage"=> "https=>//gizmodo.com/app/uploads/2025/01/The-nightmare-before-christmas-io9-loungefly-exclusive-zero-collection.jpg",
                        "publishedAt"=> "2025-01-15T16=>00=>47Z",
                        "content"=> "Isn’t it enough that the Pumpkin King of Halloween has brought Christmas into spooky season at Disneyland with the Haunted Mansion Holiday takeover? Apparently Jack Skellington and friends are descen… [+2477 chars]"
                    ]
                ]
            ];
    }

}
