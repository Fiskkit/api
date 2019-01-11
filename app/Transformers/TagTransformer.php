<?php
/**
 * Created by PhpStorm.
 * User: zeel
 * Date: 10/1/19
 * Time: 3:23 PM
 */

namespace App\Transformers;



use App\Models\Tag;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract
{
    protected $defaultIncludes = [];

    public function transform(Tag $tag)
    {
        return [
            'deprecated' => (int)$tag->deprecated,
            'description' => (string)$tag->description,
            'id' => (int)$tag->id,
            'image' => $tag->image,
            'machineName' => (string)$tag->machineName,
            'name' => (string)$tag->name,
            'triplet' => (int)$tag->triplet
        ];

    }

}