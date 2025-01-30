<?php

return [
    'news_sources' => [
        'guardian',
        'nytimes',
        'newsapi'
    ],
    'query_parameters' => env('QUERY_PARAMS', ['q' => 'technology OR fashion'])
];
