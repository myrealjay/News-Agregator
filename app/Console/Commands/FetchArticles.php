<?php

namespace App\Console\Commands;

use App\Contexts\NewsAgregator;
use App\Events\ArticlesFetched;
use App\Models\Article;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Event;

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

        $sources = config('aggregator.news_sources');

        foreach ($sources as $source) {
            $this->info("fetching for $source");

            $aggregator = new NewsAgregator($source);

            foreach ($aggregator->fetchArticles() as $article) {
                $data = $aggregator->formatData($article);

                Article::updateOrCreate(
                    [
                        'url' => $data['url']
                    ],
                    $data
                );
            }
        }

        Event::dispatch(new ArticlesFetched);

        $this->info('Done fetching articles.');
    }
}
