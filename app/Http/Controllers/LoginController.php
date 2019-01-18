<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 16/1/19
 * Time: 12:20 PM
 */

namespace App\Http\Controllers;

use App\Requests\LoginRequest;
use Laravel\Socialite\Facades\Socialite;


/**
 * @SWG\Definition(
 *       definition="LoginInput",
 *     type = "object",
 *     @SWG\Property(property="email",type="string", format="string", description="Email"),
 *     @SWG\Property(property="facebook_token",type="string",format="string",description="Facebook Taken"),
 *       ),
 *     })
 */
class LoginController extends ApiController
{

    public function login(LoginRequest $request)
    {
        try {
            $user = app('fiskkit.manager.login_manager')->login($request);
            if ($user == null) {
                $response = array(
                    'notice' => array(
                        'status' => 200,
                        'message' => 'No user found.'
                    )
                );

                return \Response::json($response, 200);
            }
            //return \Response::json($user->toArray());
            return \Response::json($user);
        } catch (\Exception $e) {
            return $this->createErrorResponse($e->getMessage());
        }
    }

    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        // $user->token;
    }
}