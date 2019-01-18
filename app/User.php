<?php

namespace App;

use App\Models\Bookmark;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    // Get all users we are following
    public function following()
    {
        return $this->belongsToMany(User::class, 'follow_users', 'user_id', 'follow_id')
            ->withTimestamps();
    }

    public function bookmarks()
    {
        return $this->belongsToMany(Bookmark::class);
    }
}
