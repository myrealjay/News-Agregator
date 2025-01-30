<?php

namespace App\Listeners;

use App\Events\ArticlesFetched;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ClearCacheedQueries
{
    /**
     * Remove all cahced queries when this event occurs.
     */
    public function handle(ArticlesFetched $event): void
    {
        //Remove cache so new items can reflect
        Log::info('Removing cached queries ...');

        $allcacheKeys = [];
        if (Cache::has('allkeys')) {
            $allcacheKeys = Cache::get('allkeys');
        }

        if (count($allcacheKeys)) {
            foreach ($allcacheKeys as $key) {
                Cache::forget($key);
            }

            Cache::forget('allkeys');
        }
    }
}
