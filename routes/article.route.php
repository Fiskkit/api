<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 9/1/19
 * Time: 6:01 PM
 */


/**
 * @SWG\Get(
 *    path = "article/slug/{slug}",
 *    tags = {"Article"},
 *    summary = "Get article by slug",
 *    produces = {"application/json"},
 *    consumes = {"application/json"},
 *    @SWG\Parameter(
 *        in = "path",
 *        name = "slug",
 *        description = "Article slug",
 *        type="string",
 *        required = true
 *    ),
 *    @SWG\Response(response=200, description="Article for given slug", @SWG\Schema(ref="#/definitions/ArticleWithParagraph")),
 *    @SWG\Response(response=422, description="Something went wrong!!!", @SWG\Schema(ref="#/definitions/Error")),
 *    @SWG\Response(response=404, description="Article not found for given slug", @SWG\Schema(ref="#/definitions/Error")),
 * )
 */
Route::get('article/slug/{slug}', 'ArticleController@getArticleBySlug');

/**
 * @SWG\Get(
 *    path = "articles",
 *    tags = {"Article"},
 *    summary = "Paginated list of articles",
 *    produces = {"application/json"},
 *    consumes = {"application/json"},
 *    @SWG\Parameter( in="query", name = "page", description = "Enter page number (1,2,3,4)", type = "integer"),
 *    @SWG\Parameter( in="query", name = "perPage", description = "Specify number of records per page to be returned", type = "integer"),
 *    @SWG\Parameter( in="query", name = "sortBy", description = "Sort results by", type = "string", default = "created_at", enum={"created_at","fisk_count"}),
 *    @SWG\Parameter( in="query", name = "orderBy", description = "Order ascending | descending", type = "string", default = "desc", enum={"asc","desc"}),
 *    @SWG\Response(response=200, description="List of articles", @SWG\Schema(ref="#/definitions/ArticleWithFiskAndShareCount")),
 *    @SWG\Response(response=422, description="Something went wrong!!!", @SWG\Schema(ref="#/definitions/Error")),
 *    @SWG\Response(response=404, description="No article found", @SWG\Schema(ref="#/definitions/Error")),
 * )
 */
Route::get('articles', 'ArticleController@getArticles');

/**
 * @SWG\Get(
 *    path = "article/{id}",
 *    tags = {"Article"},
 *    summary = "Get article by id",
 *    produces = {"application/json"},
 *    consumes = {"application/json"},
 *    @SWG\Parameter(
 *        in = "path",
 *        name = "id",
 *        description = "Article id",
 *        type="string",
 *        required = true
 *    ),
 *    @SWG\Response(response=200, description="Article for given id", @SWG\Schema(ref="#/definitions/ArticleWithParagraph")),
 *    @SWG\Response(response=422, description="Something went wrong!!!", @SWG\Schema(ref="#/definitions/Error")),
 *    @SWG\Response(response=404, description="Article not found for given id", @SWG\Schema(ref="#/definitions/Error")),
 * )
 */
Route::get('article/{id}', 'ArticleController@getArticleById');
