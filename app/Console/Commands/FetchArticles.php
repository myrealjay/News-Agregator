<?php

namespace App\Console\Commands;

use App\Helpers\NewsProviderResolver;
use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class FetchArticles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command fetches articles from various sources.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Started fetching articles.');

        $strategies = config('aggregator.news_sources');

        foreach($strategies as $strategy) {
            $this->info("fetching for $strategy");

            $provider = NewsProviderResolver::resolveNewsProvider($strategy);
            $response = $provider->fetchArticles(config('aggregator.query_parameters'));

            foreach($response as $article) {
                $data = $provider->formatData(($article));

                Article::updateOrCreate(
                    ['url' => $data['url']],
                    $data
                );
            }
        }

        $this->deleteCahceKeys();
        $this->info('Done fetching articles.');
    }

    /**
     * Forget cahced keys.
     *
     * @return void
     */
    protected function deleteCahceKeys(): void
    {
         //Remove cache so new items can reflect
         $allcacheKeys = [];
         if (Cache::has('allkeys')) {
             $allcacheKeys = Cache::get('allkeys');
         }

         if (count($allcacheKeys)) {
             foreach($allcacheKeys as $key) {
                Cache::forget($key);
             }

             Cache::forget('allkeys');
         }

    }
}
