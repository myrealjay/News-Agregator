<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Pagination\LengthAwarePaginator;

class ArticleController extends Controller
{
    protected ArticleService $articleService;

    /**
     * Initialize Article controller.
     *
     * @param ArticleService $articleService
     */
    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    /**
     * Fetch all articles.
     *
     * @param ArticleRequest $request
     * @return LengthAwarePaginator
     */
    public function index(ArticleRequest $request): LengthAwarePaginator
    {
        return  $this->articleService->index($request);
    }

    /**
     * Get a single Article.
     *
     * @param string $id
     * @return Article|null
     */
    public function show(string $id): ? Article
    {
        return $this->articleService->show($id);
    }
}
