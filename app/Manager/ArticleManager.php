<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 10/1/19
 * Time: 10:21 AM
 */

namespace App\Manager;


use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class ArticleManager
{
    public function getQueryBuilder($filter)
    {
        $sortOrder = $filter['OrderBy'] ?? 'desc';
        $sortOn = $filter['sort'] ?? 'updated';
        $articleAlias = 'articles';
        $fiskAlias = 'fisks';
        $shareAlias = 'shares';

        $queryBuilder = Article::select($articleAlias . '.*');
        $queryBuilder->join($shareAlias, $shareAlias . '.article_id', '=', $articleAlias . '.id');
        //$queryBuilder->leftJoin($fiskAlias, $fiskAlias . '.article_id', '=', $articleAlias . '.id');
        $queryBuilder->leftJoin($fiskAlias, function ($query) use($fiskAlias, $articleAlias){
            $query->on("$articleAlias.id", "=", "$fiskAlias.article_id");
            $query->where("$fiskAlias.has_content",1);
        });
        $queryBuilder->selectRaw("count($shareAlias.id) as share_count, count($fiskAlias.id) as fisk_count");
        $queryBuilder->groupBy("$articleAlias.id");
        //dd($queryBuilder->get());

        switch ($sortOn) {
            case 'created':
                $queryBuilder->orderBy($articleAlias . '.created_at', $sortOrder);
                break;
            case 'updated':
                $queryBuilder->orderBy($articleAlias . '.updated_at', $sortOrder);
                break;
            case 'social':
                //$error = $this->createErrorResponse(422, 'No user found.');
                throw new \Exception('No user found.', 422);
                break;
            default:
                $queryBuilder->orderBy($sortOn, $sortOrder);
        }

        return $queryBuilder;
        //dd($queryBuilder->toSql());
    }

    protected function createErrorResponse($status = 400, $messages)
    {
        $response = array(
            'error' => array(
                'status' => $status,
                'messages' => $messages
            )
        );

        return Response::json($response, $status);
    }
}