<?php

namespace Tests\Feature\Commands;

use App\Models\Article;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Tests\Feature\Traits\HasApiResponse;
use Tests\TestCase;

class FetchArticleCommandTest extends TestCase
{
    use RefreshDatabase;
    use HasApiResponse;

    /**
     * Check that the command actually fetches data.
     *
     * @test
     */
    public function it_fetches_data_from_sources_when_command_is_called(): void
    {
        $this->assertCount(0, Article::all());

        Http::fake([
            'https://content.guardianapis.com/*' => Http::response($this->getApiResponse('guardian'), 200),
            'https://api.nytimes.com/*' => Http::response($this->getApiResponse('nytimes'), 200),
            'https://newsapi.org/*' => Http::response($this->getApiResponse('newsapi'), 200)
        ]);

        $this->artisan('articles:fetch')
            ->assertExitCode(0);

        $this->assertGreaterThan(0, Article::count());
    }
}
