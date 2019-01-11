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


use App\Transformers\TagTransformer;

class TagController extends ApiController
{
    public function getTag() {
        try {
            $tag = request()->input();
            return $this->collection($tag, new TagTransformer());
        } catch (\Exception $e) {
            return $this->abortJsonResponse($e->getMessage(), 422);
        }
    }

}