<?php

namespace Tests\Unit;

use App\Contracts\NewsProviderContract;
use App\Services\GuardianService;
use PHPUnit\Framework\TestCase;

class GuardianServiceTest extends TestCase
{
   /**
     * Test that NewsApiService can format data correctly.
     *
     * @test
     */
    public function it_can_format_data_correctly(): void
    {
        $guardianService = new GuardianService();
        $originalData = $this->getData();

        $formattedData = $guardianService->formatData($originalData);

        $this->assertEquals($formattedData['category'], $originalData['sectionName']);

        $this->assertEquals($formattedData['published_at'], $originalData['webPublicationDate']);
    }

    /**
     * Test that NewAPiService implements NewsProviderContract.
     *
     * @test
     */
    public function verify_that_news_api_service_implements_news_provider_contract(): void
    {
        $guardianService = new GuardianService();
        $this->assertTrue($guardianService instanceof NewsProviderContract);
    }

    /**
     * Get the data.
     *
     * @return array
     */
    protected function getData(): array
    {
        return  [
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
        ];
    }
}
