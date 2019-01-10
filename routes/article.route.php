<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 9/1/19
 * Time: 6:01 PM
 */

/**
 * @SWG\Get(
 *    path = "article",
 *    tags = {"Article"},
 *    summary = "Shop list within given miles, default is 5 miles",
 *    description = "This API will give list of all shops within given miles, default is 5 miles.",
 *    produces = {"application/json"},
 *    consumes = {"application/json"},
 *    @SWG\Parameter( in="query", name = "name", description = "Name", type="string"),
 *    @SWG\Parameter( in="query", name = "page", description = "page number", type = "integer"),
 *    @SWG\Parameter( in="query", name = "includes", description = "includes relational data. Possible value is 'shopHour' ", type="string"),
 *    @SWG\Parameter( in="query", name = "lat", description = "Latitude to search", type = "string", format="string"),
 *    @SWG\Parameter( in="query", name = "lng", description = "Longitude to search", type = "string", format="string"),
 *    @SWG\Parameter( in="query", name = "distance", description = "Distance in mile to get shop from", type = "string"),
 *    @SWG\Parameter( in="query", name = "user_lat", description = "Latitude to search", type = "string", format="string"),
 *    @SWG\Parameter( in="query", name = "user_long", description = "Longitude to search", type = "string", format="string"),
 *    @SWG\Parameter( in="query", name = "perPage", description = "Per page record", type = "integer"),
 *    @SWG\Response(response=200, description="Shop details", @SWG\Schema(ref="#/definitions/Error")),
 *    @SWG\Response(response=422, description="Something went wrong!!!", @SWG\Schema(ref="#/definitions/Error")),
 * )
 */
Route::get('article', 'ArticleController@getArticles');