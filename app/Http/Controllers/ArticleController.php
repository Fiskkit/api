<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 9/1/19
 * Time: 6:09 PM
 */

namespace App\Http\Controllers;


use App\Requests\ArticleRequest;

class ArticleController extends ApiController
{
    public function getArticles(ArticleRequest $request)
    {
        //app('fiskkit.manager.article_manager')->getArticle();
    }
}