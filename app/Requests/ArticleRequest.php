<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 10/1/19
 * Time: 10:15 AM
 */

namespace App\Requests;


use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function rules()
    {
        $rules = [
            'perPage' => 'integer',
            'page' => 'integer',
            'sortBy' => 'in:created_at,fisk_count',
            'orderBy' => 'in:asc,desc'
        ];
        return $rules;
    }
}