<?php

namespace Tests\Feature\Contollers;

use App\Models\Article;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Illuminate\Support\Str;
use Tests\TestCase;

class ArticleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected User $user;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        Article::factory()->count(10)->create();
    }

    #[Test]
    public function it_fetches_articles()
    {
        $response = $this->actingAs($this->user)->get('/api/articles');
        $response->assertStatus(200)
        ->assertJsonStructure([
            "success",
            "message",
            "data" => [
                "data" => [],
                "current_page",
                "per_page",
                "total",
                "from",
                "to"
            ]

            ]);

        $this->assertCount(10, $response->json()['data']['data']);
    }

    #[Test]
    public function it_filters_based_on_search_criteria()
    {
        $article = Article::first();
        $this->assertEquals(10, Article::count());

        $response = $this->actingAs($this->user)->get("/api/articles?search=$article->title");
        $response->assertStatus(200);
        $this->assertNotEquals(10, count($response->json()['data']['data']));
    }

    #[Test]
    public function it_filters_based_on_category()
    {
        $threeArticles = Article::take(3)->get();
        $myUniqueCategory = Str::uuid();

        foreach($threeArticles as $article) {
            $article->update([
                'category' => $myUniqueCategory
            ]);
        }

        $articlesCount = Article::where('category', $myUniqueCategory)->count();

        $response = $this->actingAs($this->user)->get("/api/articles?category=$myUniqueCategory");
        $response->assertStatus(200);
        $this->assertCount($articlesCount, $response->json()['data']['data']);
    }

    #[Test]
    public function it_filters_based_on_date()
    {
        $threeArticles = Article::take(3)->get();
        $today = date('Y-m-d');

        foreach($threeArticles as $article) {
            $article->update([
                'published_at' => $today
            ]);
        }

        $articlesCount = Article::whereDate('published_at', $today)->count();

        $response = $this->actingAs($this->user)->get("/api/articles?date=$today");
        $response->assertStatus(200);
        $this->assertCount($articlesCount, $response->json()['data']['data']);
    }

    #[Test]
    public function it_fetches_based_on_user_selected_categories_in_preferences()
    {
        $threeArticles = Article::take(3)->get();
        $uniqueCategory = Str::uuid();

        $this->user->preferences()->create([
            'categories' => [$uniqueCategory]
        ]);

        foreach($threeArticles as $article) {
            $article->update(['category' => $uniqueCategory]);
        }

        $articlesCount = Article::where('category', $uniqueCategory)->count();

        $response = $this->actingAs($this->user)->get("/api/articles");
        $response->assertStatus(200);

        $this->assertCount($articlesCount, $response->json()['data']['data']);
    }

    #[Test]
    public function it_fetches_based_on_user_selected_sources_in_preferences()
    {
        $threeArticles = Article::take(3)->get();
        $uniqueSource = Str::uuid();

        $this->user->preferences()->create([
            'sources' => [$uniqueSource]
        ]);

        foreach($threeArticles as $article) {
            $article->update(['source' => $uniqueSource]);
        }

        $articlesCount = Article::where('source', $uniqueSource)->count();

        $response = $this->actingAs($this->user)->get("/api/articles");
        $response->assertStatus(200);
        $this->assertCount($articlesCount, $response->json()['data']['data']);
    }

    #[Test]
    public function it_fetches_based_on_user_selected_authors_in_preferences()
    {
        $threeArticles = Article::take(3)->get();
        $uniqueAuthor = Str::uuid();

        $this->user->preferences()->create([
            'authors' => [$uniqueAuthor]
        ]);

        foreach($threeArticles as $article) {
            $article->update(['author' => $uniqueAuthor]);
        }

        $articlesCount = Article::where('author', $uniqueAuthor)->count();

        $response = $this->actingAs($this->user)->get("/api/articles");
        $response->assertStatus(200);
        $this->assertCount($articlesCount, $response->json()['data']['data']);
    }

    #[Test]
    public function it_fetches_single_article_by_id()
    {
        $article = Article::first();
        $response = $this->actingAs($this->user)->get("/api/articles/$article->id");

        $response->assertStatus(200)
        ->assertJsonStructure([
            'success',
            "message",
            "data"
        ])
        ->assertSee(['title' => $article->title]);
    }
}
