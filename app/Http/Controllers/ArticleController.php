<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Services\ArticleService;
use App\Traits\HasResponse;
use Illuminate\Http\JsonResponse;

class ArticleController extends Controller
{
    use HasResponse;

    /**
     * Article service instance
     * @var ArticleService
     */
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
     * @return JsonResponse
     */
    public function index(ArticleRequest $request): JsonResponse
    {
        $articles = $this->articleService->fetchArticles($request);
        return  $this->sendResponse(true, 'Articles fetched successfully', $articles);
    }

    /**
     * Get a single Article.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $article = $this->articleService->getArticleById($id);
        return $this->sendResponse(true, 'Article fetched successfully', $article);
    }
}
