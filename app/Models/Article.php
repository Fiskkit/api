<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 9/1/19
 * Time: 5:58 PM
 */

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Article extends Model
{
    use HasSlug;
    public $incrementing = false;
    protected $keyType = 'string';

    public function sentences()
    {
        return $this->hasMany(Sentence::class);
    }

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(function($article) {
                $url = str_replace('https://', '', $article->url);
                $url = str_replace('http://', '', $url);
                $url = str_replace('.', '-', $url);
                $url = str_replace('/', '-', $url);
                return $url;
            })
            ->doNotGenerateSlugsOnUpdate()
            ->saveSlugsTo('slug');
    }
}