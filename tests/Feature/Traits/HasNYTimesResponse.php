<?php

namespace Tests\Feature\Traits;

trait HasNYTimesResponse
{
     /**
     * Get the data returned from API call.
     *
     * @return array
     */
    protected function getApiResponse(): array
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
                    "url"=> "https=>//www.nytimes.com/2025/01/28/us/politics/trump-pentagon-milley-security.html",
                    "uri"=> "nyt=>//article/fa9728a8-b29a-576d-9c79-69932bccebb4",
                    "byline"=> "By Eric Schmitt and David E. Sanger",
                    "item_type"=> "Article",
                    "updated_date"=> "2025-01-28T23=>38=>01-05=>00",
                    "created_date"=> "2025-01-28T23=>31=>25-05=>00",
                    "published_date"=> "2025-01-28T23=>31=>25-05=>00",
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
                            "url"=> "https=>//static01.nyt.com/images/2025/01/28/multimedia/28trump-news-hegseth-milley-khpl/28trump-news-hegseth-milley-khpl-superJumbo.jpg",
                            "format"=> "Super Jumbo",
                            "height"=> 1365,
                            "width"=> 2048,
                            "type"=> "image",
                            "subtype"=> "photo",
                            "caption"=> "Gen. Mark A. Milley during a House Foreign Affairs Committee hearing at the Capitol in Washington last year.",
                            "copyright"=> "Haiyun Jiang for The New York Times"
                        ],
                        [
                            "url"=> "https=>//static01.nyt.com/images/2025/01/28/multimedia/28trump-news-hegseth-milley-khpl/28trump-news-hegseth-milley-khpl-threeByTwoSmallAt2X.jpg",
                            "format"=> "threeByTwoSmallAt2X",
                            "height"=> 400,
                            "width"=> 600,
                            "type"=> "image",
                            "subtype"=> "photo",
                            "caption"=> "Gen. Mark A. Milley during a House Foreign Affairs Committee hearing at the Capitol in Washington last year.",
                            "copyright"=> "Haiyun Jiang for The New York Times"
                        ],
                        [
                            "url"=> "https=>//static01.nyt.com/images/2025/01/28/multimedia/28trump-news-hegseth-milley-khpl/28trump-news-hegseth-milley-khpl-thumbLarge.jpg",
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
