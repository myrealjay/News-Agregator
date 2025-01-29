<?php

namespace Tests\Unit;

use App\Contracts\NewsProviderContract;
use App\Services\NewsAPIService;
use PHPUnit\Framework\TestCase;

class NewsApiServiceTest extends TestCase
{
    /**
     * Test that NewsApiService can format data correctly.
     *
     * @test
     */
    public function it_can_format_data_correctly(): void
    {
        $newsApiService = new NewsAPIService();
        $originalData = $this->getData();

        $formattedData = $newsApiService->formatData($originalData);

        $this->assertEquals($formattedData['source'], $originalData['source']['name']);

        $this->assertEquals($formattedData['title'], $originalData['title']);
    }

    /**
     * Test that NewAPiService implements NewsProviderContract.
     *
     * @test
     */
    public function verify_that_news_api_service_implements_news_provider_contract(): void
    {
        $newsApiService = new NewsAPIService();
        $this->assertTrue($newsApiService instanceof NewsProviderContract);
    }

    /**
     * Get the data.
     *
     * @return array
     */
    protected function getData(): array
    {
        return  [
            "source"=> [
                "id"=> "wired",
                "name"=> "Wired"
            ],
            "author"=> "Vittoria Elliott",
            "title"=> "Gold Sneakers and Too-Tight Suits=> The Menswear Guy Weighs In on Inauguration Weekend",
            "description"=> "Menswear influencer Derek Guy is unimpressed by what tech barons and the MAGA rank and file wore this weekend. “To be frank,” he says, “many conservatives are often behind on fashion trends.”",
            "url"=> "https=>//www.wired.com/story/menswear-guy-maga-tight-suits-gold-sneakers/",
            "urlToImage"=> "https=>//media.wired.com/photos/678eb4eae2eb3c757494ed1c/191=>100/w_1280,c_limit/maga-fashion-pol.jpg",
            "publishedAt"=> "2025-01-21T12:00:00Z",
            "content"=> "Do you think that sort of classic American lookthe Ralph Lauren, the Oxford shirtis that going to be sort of the purview of MAGA forever or do you see that changing?\r\nI don't think the classic Americ… [+3749 chars]"
        ];
    }
}
