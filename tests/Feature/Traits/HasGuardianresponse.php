<?php

namespace Tests\Feature\Traits;

trait HasGuardianresponse
{
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
