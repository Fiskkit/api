<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 9/1/19
 * Time: 6:01 PM
 */

/**
 * @SWG\Get(
 *    path = "articles",
 *    tags = {"Article"},
 *    summary = "Shop list within given miles, default is 5 miles",
 *    description = "This API will give list of all shops within given miles, default is 5 miles.",
 *    produces = {"application/json"},
 *    consumes = {"application/json"},
 *    @SWG\Parameter( in="query", name = "display_respected_comments", description = "Display Respected Comments", type="integer"),
 *    @SWG\Parameter( in="query", name = "limit", description = "Limit", type="integer"),
 *    @SWG\Parameter( in="query", name = "offset", description = "offset", type = "integer"),
 *    @SWG\Parameter( in="query", name = "id", description = "User Id", type = "integer"),
 *    @SWG\Parameter( in="query", name = "last_x_hours", description = "Last X Hours", type = "integer"),
 *    @SWG\Parameter( in="query", name = "sort", description = "Sort", type = "string", enum={"updated","created","fisk_updated","fisk_count","bookmark_updated","share_count","social","trending"}),
 *    @SWG\Parameter( in="query", name = "OrderBy", description = "Order by", type = "string", enum={"asc","desc"}),
 *    @SWG\Response(response=200, description="Shop details", @SWG\Schema(ref="#/definitions/Error")),
 *    @SWG\Response(response=422, description="Something went wrong!!!", @SWG\Schema(ref="#/definitions/Error")),
 * )
 */
Route::get('articles', 'ArticleController@getArticles');