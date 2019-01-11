<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 9/1/19
 * Time: 6:09 PM
 */

namespace App\Http\Controllers;


use App\Requests\ArticleRequest;
use Illuminate\Support\Facades\Auth;

class ArticleController extends ApiController
{
    public function getArticles(ArticleRequest $request)
    {
        try {
            $queryBuilder = app('fiskkit.manager.article_manager')->getQueryBuilder($request->all());
            dd($request->input());
            dd('Inside controller');
        } catch (\Exception $e) {
        }
    }
}