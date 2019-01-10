<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 9/1/19
 * Time: 4:49 PM
 */

/**
 * @SWG\Swagger(
 *     @SWG\Info(
 *         version="1.0.0",
 *         title="Fiskkit API",
 *         @SWG\Contact(name="Atyantik Technologies Pvt. Ltd.", email="admin@atyantik.com"),
 *         @SWG\License(name="Licenced Not Specified", url="http://creativecommons.org/licenses/by/4.0/")
 *     ),
 *     @SWG\Definition(
 *         definition="Error",
 *         required={"message"},
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     ),
 *     @SWG\Definition(
 *         definition="JWTToken",
 *         @SWG\Property(
 *             property="token",
 *             type="string",
 *             format="string",
 *             description="JWT Token"
 *         ),
 *     ),
 *     @SWG\Definition(
 *         definition="Success",
 *         required={"message"},
 *         @SWG\Property(
 *             property="message",
 *             type="string"
 *         )
 *     ),
 * )
 */