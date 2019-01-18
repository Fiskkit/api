<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 16/1/19
 * Time: 12:51 PM
 */

namespace App\Manager;


use App\Requests\LoginRequest;
use App\User;
use GuzzleHttp;
use GuzzleHttp\Exception\RequestException;
use Tymon\JWTAuth\Facades\JWTAuth;

class LoginManager
{
    public function login(LoginRequest $request)
    {
        if ($request->filled('facebook_token')) {
            $facebook_profile = $this->getFBProfile($request->facebook_token);

            // Get an existing user, or create a new one based on facebook id.
            $user = User::first(array('facebook_id' => $facebook_profile->getId()));
            if ($user == null) {
                $user = new User();
                $user->facebook_id = $facebook_profile->getId();
                $user->email = $facebook_profile->getProperty('email');
                $user->first_name = $facebook_profile->getFirstName();
                $user->last_name = $facebook_profile->getLastName();
                $user->name = $user->first_name . ' ' . $user->last_name;
            }
            //$user->facebook_session_token = $session->getToken();
            $user->save();
        } else {
            $user = User::where('email', '=', $request->email)->first();
        }

        if ($user) {
            $token = $this->generateUserToken($user);
        }
        //return $user;
        return $token;
    }

    public function generateUserToken(User $user)
    {
        $token = JWTAuth::fromUser($user);
        JWTAuth::setToken($token)->toUser();
        return $token;
    }

    protected function getFBProfile($accessToken)
    {
        $client = new GuzzleHttp\Client();
        try {
            $result = $client->request('GET', 'https://graph.facebook.com/me?access_token=' . $accessToken . '&fields=first_name,last_name,name,email,picture', [
                'connect_timeout' => 10
            ]);
            //dd($result);
            $response = json_decode($result->getBody()->getContents());
            return $response;
        } catch (RequestException $e) {
            // To catch exactly error 400 use
            if ($e->getResponse()->getStatusCode() == '400') {
                throw new \Exception('Invalid facebook token.', 400);
            }
        } catch (\Exception $e) {
            throw $e;
        }
        return false;
    }
}