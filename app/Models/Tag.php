<?php
/**
 * Created by PhpStorm.
 * User: zeel
 * Date: 10/1/19
 * Time: 2:27 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'deprecated',
        'description',
        'id',
        'image',
        'machineName',
        'name',
        'triplet'
    ];

}