<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 16/1/19
 * Time: 12:05 PM
 */

use Illuminate\Support\Facades\Route;

/**
 * @SWG\Post(
 *    path = "login",
 *    tags = {"Authentication"},
 *    summary = "User Login",
 *    description = "This API is used for user login using social login",
 *    produces = {"application/json"},
 *    consumes = {"application/json"},
 *    @SWG\Parameter(
 *        in = "body",
 *        name = "login",
 *        description = "User Login Details",
 *        type="object",
 *        @SWG\Schema(
 *            ref="#/definitions/LoginInput"
 *         )
 *    ),
 *    @SWG\Response(response=200, description="Valid new JWT Token", @SWG\Schema(ref="#/definitions/JWTToken")),
 *    @SWG\Response(response=401, description="Invalid username/password.", @SWG\Schema(ref="#/definitions/Error")),
 *    @SWG\Response(response=422, description="Something went wrong!!!", @SWG\Schema(ref="#/definitions/Error")),
 * )
 */
Route::post('login', 'LoginController@login');