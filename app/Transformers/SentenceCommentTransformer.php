<?php
/**
 * Created by PhpStorm.
 * User: hiteshkubavat
 * Date: 18/1/19
 * Time: 2:30 PM
 */

namespace App\Transformers;


use League\Fractal\TransformerAbstract;

class SentenceCommentTransformer extends TransformerAbstract
{
    public function transform($sentenceComment)
    {
        return [
            'respect_count' => $sentenceComment->respect_count,
            'body' => $sentenceComment->body,
            'created_at' => $sentenceComment->created_at,
            'updated_at' => $sentenceComment->updated_at,
            'word_count' => $sentenceComment->word_count,
            'fisk_id' => $sentenceComment->fisk_id,
            'article_id' => $sentenceComment->article_id,
            'user_id' => $sentenceComment->user_id,
            'full_name' => $sentenceComment->full_name,
            'first_name' => $sentenceComment->first_name,
            'last_name' => $sentenceComment->last_name,
            'facebook_id' => $sentenceComment->facebook_id,
            'linkedin_profile_image' => $sentenceComment->linkedin_profile_image,
            'org_id' => $sentenceComment->org_id,
            'org_slug' => $sentenceComment->org_slug,
            'org_name' => $sentenceComment->org_name,
            'org_mission' => $sentenceComment->org_mission,
            'org_logo' => $sentenceComment->org_logo,
            'org_url' => $sentenceComment->org_url,
            'org_url_text' => $sentenceComment->org_url_text,
            'org_created_at' => $sentenceComment->org_created_at,
            'user_respect_count' => $sentenceComment->user_respect_count,
            'user_fisk_count' => $sentenceComment->user_fisk_count,
        ];
    }
}