<?php
/**
 * Created by PhpStorm.
 * User: zeel
 * Date: 10/1/19
 * Time: 12:40 PM
 */


/**
 * @SWG\Get(
 *    path = "tags",
 *    tags = {"Tags"},
 *    summary = "Tag list",
 *    description = "This API will give list of all tags",
 *    produces = {"application/json"},
 *    consumes = {"application/json"},
 *    @SWG\Response(response=200, description="Tag details", @SWG\Schema(ref="#/definitions/Tag")),
 *    @SWG\Response(response=422, description="Something went wrong!!!", @SWG\Schema(ref="#/definitions/Error")),
 * )
 */

/**
 * @SWG\Get(
 *    path = "tags/{tag_id}",
 *    tags = {"Tags"},
 *    summary = "Tag list",
 *    description = "This API will give list of all tags",
 *    produces = {"application/json"},
 *    consumes = {"application/json"},
 *    @SWG\Parameter( in="path", name = "tag_id", description = "Tag id", type="number", required = true),
 *    @SWG\Response(response=200, description="Tag details", @SWG\Schema(ref="#/definitions/Tag")),
 *    @SWG\Response(response=422, description="Something went wrong!!!", @SWG\Schema(ref="#/definitions/Error")),
 * )
 */
Route::get('tags/{tag_id?}', 'TagController@getTag');