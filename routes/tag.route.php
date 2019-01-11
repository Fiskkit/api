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
 *    @SWG\Response(response=200, description="Shop details", @SWG\Schema(ref="#/definitions/Tag")),
 *    @SWG\Response(response=422, description="Something went wrong!!!", @SWG\Schema(ref="#/definitions/Error")),
 * )
 */
Route::get('tags', 'TagController@getTag');