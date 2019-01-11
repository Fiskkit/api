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
            'limit' => 'integer',
            'offset' => 'integer',
            'last_x_hours' => 'integer',
            'display_respected_comments' => 'boolean',
            'sort' => 'in:created,updated,fisk_updated,fisk_count,bookmark_updated,share_count,social,trending'
        ];
        return $rules;
    }

    public function withValidator($validatar)
    {
        if (!$this->filled('limit')) {
            $this->merge(['limit' => 20]);
        }
        if (!$this->filled('offset')) {
            $this->merge(['offset' => 0]);
        }

        $validatar->after(function ($validator) {
            if($this->filled('last_x_hours') && $this->last_x_hours > 720) {
                $validator->errors()->add('last_x_hours', 'last x hours is too high.');
            }
        });
    }
}