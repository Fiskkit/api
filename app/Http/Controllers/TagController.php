<?php
/**
 * Created by PhpStorm.
 * User: zeel
 * Date: 10/1/19
 * Time: 12:37 PM
 */

namespace App\Http\Controllers;


/**
 * @SWG\Definition(
 *     definition="Tag",
 *     @SWG\Property(property="deprecated", type="number"),
 *     @SWG\Property(property="description", type="string"),
 *     @SWG\Property(property="id", type="number"),
 *     @SWG\Property(property="image", type="string"),
 *     @SWG\Property(property="machineName", type="string"),
 *     @SWG\Property(property="name", type="string"),
 *     @SWG\Property(property="triplet", type="number"),
 * )
 */


use App\Models\Tag;
//use App\Requests\TagRequest;
//use App\Transformers\TagTransformer;
//use function PhpParser\filesInDir;

class TagController extends ApiController
{
    public function getTag($tagId = null) {
        try {
            if (isset($tagId)) {
                $tag = Tag::find($tagId);
                return $tag;
                //return $this->item($tag, new TagTransformer());
            }
                $tag = Tag::all();
                return $tag;
                //return $this->collection($tag, new TagTransformer());
        } catch (\Exception $e) {
            return $this->abortJsonResponse($e->getMessage(), 422);
        }
    }

}