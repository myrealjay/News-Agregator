<?php

namespace App\Console\Commands;

use App\Helpers\NewsProviderResolver;
use App\Models\Article;
use Illuminate\Console\Command;

use function App\Helpers\resolveNewsProvider;

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

        $strategies = config('aggregator.strategies');

        foreach($strategies as $strategy) {
            $provider = NewsProviderResolver::resolveNewsProvider($strategy);
            $response = $provider->fetchArticles(['q' => 'technology OR fashion']);
            foreach($response as $article) {
                $data = $provider->formatData(($article));

                Article::updateOrCreate(
                    ['url' => $data['url']],
                    $data
                );
            }
        }

        $this->info('Done fetching articles.');
    }
}
