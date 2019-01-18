<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 10/1/19
 * Time: 10:21 AM
 */

namespace App\Manager;


use App\Models\Article;
use Tymon\JWTAuth\Facades\JWTAuth;

class ArticleManager
{
    public function getQueryBuilder($request)
    {
        $filter = $request->all();
        $sortOrder = $filter['orderBy'] ?? 'desc';
        $sortOn = $filter['sortBy'] ?? 'created_at';
        $articleAlias = 'articles';
        $fiskAlias = 'fisks';
        $shareAlias = 'shares';

        $queryBuilder = Article::select($articleAlias . '.id', $articleAlias . '.title',
            $articleAlias . '.author',$articleAlias . '.publisher', $articleAlias . '.url',
            $articleAlias . '.created_at', $articleAlias . '.image_url', $articleAlias . '.read_mins',
            $articleAlias . '.slug', $fiskAlias . '.updated_at as last_fisked_at');
        $queryBuilder->leftJoin($shareAlias, $shareAlias . '.article_id', '=', $articleAlias . '.id');
        $queryBuilder->leftJoin($fiskAlias, function ($query) use ($fiskAlias, $articleAlias) {
            $query->on("$articleAlias.id", "=", "$fiskAlias.article_id");
            $query->where("$fiskAlias.has_content", 1);
        });
        $queryBuilder->selectRaw("count(DISTINCT $shareAlias.id) as share_count, count(DISTINCT $fiskAlias.id) as fisk_count");
        $queryBuilder->groupBy("$articleAlias.id");

        switch ($sortOn) {
            case 'created_at':
                $queryBuilder->orderBy($articleAlias . '.created_at', $sortOrder);
                break;
            default:
                $queryBuilder->orderBy($sortOn, $sortOrder);
        }
        return $queryBuilder;
    }

    public function getUserFromToken($request)
    {
        JWTAuth::parseToken();
        $token = $request->bearerToken();
        $user = JWTAuth::toUser($token);
        return $user;
    }
}