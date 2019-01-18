<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 16/1/19
 * Time: 12:40 PM
 */

namespace App\Requests;


use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'email' => 'email|required_without:facebook_token',
            'facebook_token' => 'required_without:email',
        ];

        return $rules;
    }
}