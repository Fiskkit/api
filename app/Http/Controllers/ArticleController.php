<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 9/1/19
 * Time: 6:09 PM
 */

namespace App\Http\Controllers;


use App\Models\Article;
use App\Requests\ArticleRequest;
use App\Transformers\ArticleTransformer;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ArticleController extends ApiController
{
    protected $articleManager;
    public function __construct()
    {
        $this->articleManager = app('fiskkit.manager.article_manager');
        //$this->middleware('jwt.auth');
    }

    public function getArticles(ArticleRequest $request)
    {
        try {
            $articles = $this->articleManager->getQueryBuilder($request);
            if ($articles->get()->count()) {
                return $this->paginateCollection($articles, new ArticleTransformer('displayShareCount'));
            }
            return $this->abortJsonResponse('No article found', 404);
        } catch (\Exception $e) {
            return $this->abortJsonResponse($e->getMessage(), 422);
        }
    }

    public function getArticleById($id)
    {
        try {
            $article = Article::findOrFail($id);

            return $this->item($article, new ArticleTransformer('doNotDisplay', 'displayParagraph'));
        } catch (ModelNotFoundException $e) {
            return $this->abortJsonResponse('Article not found for given id', 404);
        } catch (\Exception $e) {
            return $this->abortJsonResponse($e->getMessage(), 422);
        }
    }

    public function getArticleBySlug($slug)
    {
        try {
            $article = $this->articleManager->getArticleBySlug($slug);
            if($article) {
                return $this->item($article, new ArticleTransformer('doNotDisplay', 'displayParagraph'));
            }
            return $this->abortJsonResponse('Article not found for given slug', 404);
        } catch (\Exception $e) {
            return $this->abortJsonResponse($e->getMessage(), 422);
        }
    }
}