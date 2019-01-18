<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 11/1/19
 * Time: 3:22 PM
 */

namespace App\Transformers;


use App\Models\Article;
use App\Models\SentenceComment;
use League\Fractal\TransformerAbstract;

/**
 * @SWG\Definition(
 *       definition="Article",
 *     type = "object",
 *     allOf = {
 *          @SWG\Schema(
 *         @SWG\Property(property="share_count",type="integer"),
 *         @SWG\Property(property="fisk_count",type="integer"),
 *         @SWG\Property(property="last_fisked_at",type="string"),
 *          ),
 *     @SWG\Schema(ref="#/definitions/ArticleById"),
 *     })
 */

/**
 * @SWG\Definition(
 *         definition="ArticleById",
 *         @SWG\Property(property="id",type="string"),
 *         @SWG\Property(property="title",type="string"),
 *         @SWG\Property(property="slug",type="string"),
 *         @SWG\Property(property="author",type="string"),
 *         @SWG\Property(property="comment_count",type="integer"),
 *         @SWG\Property(property="publisher",type="string"),
 *         @SWG\Property(property="url",type="string"),
 *         @SWG\Property(property="image_url",type="string"),
 *         @SWG\Property(property="created_at",type="string"),
 *         @SWG\Property(property="read_mins",type="integer"),
 *     ),
 */

class ArticleTransformer extends TransformerAbstract
{
    //protected $availableIncludes = ['sentence'];
    //protected $defaultIncludes = [];

    protected  $shareCount;
    protected  $paragraph;
    public function __construct($shareCount = null, $paragraph = null)
    {
        $this->shareCount = $shareCount;
        $this->paragraph = $paragraph;
    }

    public function transform(Article $article)
    {
        $data =  [
            "id" => $article->id,
            "title" => $article->title,
            "slug" => $article->slug,
            "author" => $article->author,
            "comment_count" => $this->getCommentCount($article->id),
            "publisher" => $article->publisher,
            "url" => $article->url,
            "image_url" => $article->image_url,
            "created_at" => $article->created_at,
            "read_mins" => $article->read_mins,
        ];

        if($this->shareCount == 'displayShareCount') {
            $data["fisk_count"] = $article->fisk_count;
            $data["share_count"] = $article->share_count;
            $data["last_fisked_at"] = $article->last_fisked_at;
        }
        if($this->paragraph == 'displayParagraph') {
            $data["paragraphs"] = $this->getParagraphs($article);
        }
        return $data;
    }

    public function includeDisplayRespectedComments($article)
    {
        $sentenceCommentAlias = 'sentence_comments';
        $respectAlias = 'respects';
        $fiskAlias = 'fisks';
        $userAlias = 'users';
        $userOrgAlias = 'users_organizations';
        $orgAlias = 'organizations';

        $queryBuilder = SentenceComment::select(
            $sentenceCommentAlias. '.*',
            $fiskAlias. '.*',
            $userAlias. '.*',
            $orgAlias. '.*'
        );
        $queryBuilder->leftJoin($respectAlias, $respectAlias . '.comment_id', '=', $sentenceCommentAlias . '.id');
        $queryBuilder->join($fiskAlias, $fiskAlias. '.id', '=', $sentenceCommentAlias . '.fisk_id');
        $queryBuilder->join($userAlias, $userAlias. '.id', '=', $fiskAlias . '.id');
        $queryBuilder->leftJoin($userOrgAlias, $userAlias. '.id', '=', $userOrgAlias . '.user_id');
        $queryBuilder->leftJoin($orgAlias, $userOrgAlias. '.org_id', '=', $orgAlias . '.id');
        $queryBuilder->selectRaw("count($respectAlias.id) as respect_count");
        $queryBuilder->where([$fiskAlias.'.article_id' => $article->id]);
        $queryBuilder->where($sentenceCommentAlias.'.word_count', '>', 4);
        $queryBuilder->orderBy('respect_count', 'desc');
        $queryBuilder->groupBy($fiskAlias. '.id');
        $queryBuilder->take(4);

        return $this->collection($queryBuilder->get(), new SentenceCommentTransformer());
    }

    public function getParagraphs($article)
    {
        $paragraph = 0;
        $paragraphs = [];
        foreach ($article->sentences as $sentence) {
            if (!isset($paragraphs[$paragraph])) {
                $paragraphs[$paragraph] = [];
            }
            $paragraphs[$paragraph][] = $sentence->toArray();
            if ($sentence->eop == 1) {
                $paragraph++;
            }
        }
        return $paragraphs;
    }

    public function getCommentCount($articleId)
    {
        $sentenceCommentAlias = 'sentence_comments';
        $sentenceAlias = 'sentences';
        $queryBuilder = SentenceComment::query();
        $queryBuilder->join($sentenceAlias, $sentenceAlias . '.id', '=', $sentenceCommentAlias. '.sentence_id')
            ->where($sentenceAlias . '.article_id', $articleId);

        return $queryBuilder->count($sentenceCommentAlias.'.id');
    }
}