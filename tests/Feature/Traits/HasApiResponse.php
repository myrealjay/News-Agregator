<?php

namespace Tests\Feature\Traits;

trait HasApiResponse
{
    protected function getApiResponse(string $source): array
    {
        switch($source) {
            case 'newsapi':
                return $this->getNewsApi();
            case 'guardian':
                return $this->getGuardian();
            case 'nytimes':
                return $this->getNYTimes();
            default:
                return [];
        }
    }

    /**
     * Get the data returned from API call.
     *
     * @return array
     */
    protected function getGuardian(): array
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
                        "webPublicationDate"=> "2025-01-28T18:10:43Z",
                        "webTitle"=> "The stock market is always terrible at valuing technology revolutions",
                        "webUrl"=> "https://www.theguardian.com/business/nils-pratley-on-finance/2025/jan/28/the-stock-market-is-always-terrible-at-valuing-technology-revolutions",
                        "apiUrl"=> "https://content.guardianapis.com/business/nils-pratley-on-finance/2025/jan/28/the-stock-market-is-always-terrible-at-valuing-technology-revolutions",
                        "isHosted"=> false,
                        "pillarId"=> "pillar/news",
                        "pillarName"=> "News"
                    ],
                    [
                        "id"=> "fashion/2025/jan/05/rosita-missoni-obituary",
                        "type"=> "article",
                        "sectionId"=> "fashion",
                        "sectionName"=> "Fashion",
                        "webPublicationDate"=> "2025-01-05T17:52:27Z",
                        "webTitle"=> "Rosita Missoni obituary",
                        "webUrl"=> "https://www.theguardian.com/fashion/2025/jan/05/rosita-missoni-obituary",
                        "apiUrl"=> "https://content.guardianapis.com/fashion/2025/jan/05/rosita-missoni-obituary",
                        "isHosted"=> false,
                        "pillarId"=> "pillar/lifestyle",
                        "pillarName"=> "Lifestyle"
                    ]
                ]
            ]
        ];
    }

     /**
     * Get the data returned from API call.
     *
     * @return array
     */
    protected function getNewsApi(): array
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
                        "url"=> "https://www.wired.com/story/menswear-guy-maga-tight-suits-gold-sneakers/",
                        "urlToImage"=> "https://media.wired.com/photos/678eb4eae2eb3c757494ed1c/191=>100/w_1280,c_limit/maga-fashion-pol.jpg",
                        "publishedAt"=> "2025-01-21T12:00:00Z",
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
                        "url"=> "https://gizmodo.com/loungefly-nightmare-before-christmas-zero-collection-valentines-day-2000550360",
                        "urlToImage"=> "https://gizmodo.com/app/uploads/2025/01/The-nightmare-before-christmas-io9-loungefly-exclusive-zero-collection.jpg",
                        "publishedAt"=> "2025-01-15T16:00:47Z",
                        "content"=> "Isn’t it enough that the Pumpkin King of Halloween has brought Christmas into spooky season at Disneyland with the Haunted Mansion Holiday takeover? Apparently Jack Skellington and friends are descen… [+2477 chars]"
                    ]
                ]
            ];
    }

    /**
     * Get the data returned from API call.
     *
     * @return array
     */
    protected function getNYTimes(): array
    {
        return  [
            "status" => "OK",
            "copyright" => "Copyright (c) 2025 The New York Times Company. All Rights Reserved.",
            "section" => "home",
            "last_updated" => "2025-01-29T00:46:02-05:00",
            "num_results" => 27,
            "results" => [
                [
                    "section"=> "us",
                    "subsection"=> "politics",
                    "title"=> "Pentagon Removes General Milley’s Security Detail and Orders Review of His Record",
                    "abstract"=> "The Pentagon has asked its inspector general to review the record and behavior of General Mark A. Milley, the retired chairman of the Joint Chiefs of Staff who stood up to President Trump in his first term.",
                    "url"=> "https://www.nytimes.com/2025/01/28/us/politics/trump-pentagon-milley-security.html",
                    "uri"=> "nyt=>//article/fa9728a8-b29a-576d-9c79-69932bccebb4",
                    "byline"=> "By Eric Schmitt and David E. Sanger",
                    "item_type"=> "Article",
                    "updated_date"=> "2025-01-28T23:38:01-05:00",
                    "created_date"=> "2025-01-28T23:31:25-05:00",
                    "published_date"=> "2025-01-28T23:31:25-05:00",
                    "material_type_facet"=> "",
                    "kicker"=> "",
                    "des_facet"=> [
                        "United States Defense and Military Forces",
                        "United States Politics and Government",
                        "Inspectors General"
                    ],
                    "org_facet"=> [
                        "Joint Chiefs of Staff",
                        "Defense Department"
                    ],
                    "per_facet"=> [],
                    "geo_facet"=> [],
                    "multimedia"=> [
                        [
                            "url"=> "https://static01.nyt.com/images/2025/01/28/multimedia/28trump-news-hegseth-milley-khpl/28trump-news-hegseth-milley-khpl-superJumbo.jpg",
                            "format"=> "Super Jumbo",
                            "height"=> 1365,
                            "width"=> 2048,
                            "type"=> "image",
                            "subtype"=> "photo",
                            "caption"=> "Gen. Mark A. Milley during a House Foreign Affairs Committee hearing at the Capitol in Washington last year.",
                            "copyright"=> "Haiyun Jiang for The New York Times"
                        ],
                        [
                            "url"=> "https://static01.nyt.com/images/2025/01/28/multimedia/28trump-news-hegseth-milley-khpl/28trump-news-hegseth-milley-khpl-threeByTwoSmallAt2X.jpg",
                            "format"=> "threeByTwoSmallAt2X",
                            "height"=> 400,
                            "width"=> 600,
                            "type"=> "image",
                            "subtype"=> "photo",
                            "caption"=> "Gen. Mark A. Milley during a House Foreign Affairs Committee hearing at the Capitol in Washington last year.",
                            "copyright"=> "Haiyun Jiang for The New York Times"
                        ],
                        [
                            "url"=> "https://static01.nyt.com/images/2025/01/28/multimedia/28trump-news-hegseth-milley-khpl/28trump-news-hegseth-milley-khpl-thumbLarge.jpg",
                            "format"=> "Large Thumbnail",
                            "height"=> 150,
                            "width"=> 150,
                            "type"=> "image",
                            "subtype"=> "photo",
                            "caption"=> "Gen. Mark A. Milley during a House Foreign Affairs Committee hearing at the Capitol in Washington last year.",
                            "copyright"=> "Haiyun Jiang for The New York Times"
                        ]
                    ],
                    "short_url"=> ""
                 ]
            ]
        ];
    }
}
