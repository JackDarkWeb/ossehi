<?php

namespace App\Models;

use App\Services\PostService;
use App\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use PostService;


    public $timestamps = true;

    protected $table = 'comments';

    protected $fillable = [
        'body',
        'user_id',

    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Get the owning commentable model.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Get the user that owns the comments.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return array|Application|Translator|string|null
     */
    public function getDateCommentAttribute()
    {
        return $this->timeAgo($this->created_at);
    }
}
