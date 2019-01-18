<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 18/1/19
 * Time: 6:38 PM
 */

namespace App\Transformers;


use App\Models\Sentence;
use League\Fractal\TransformerAbstract;

class SentenceTransformer extends TransformerAbstract
{
    public function transform(Sentence $sentence)
    {
        return [
            'id' => $sentence->id,
            'body' => $sentence->body,
        ];
    }
}