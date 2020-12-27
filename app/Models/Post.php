<?php

namespace App\Models;

use App\Services\PostService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use PostService;


    public $timestamps = true;

    protected $table = "posts";

    protected $fillable = [
        'title',
        'content',
        'author',
        'slug',
        'image',
        'published',
        'archive'
    ];

    protected $casts = [
        'created_at',
        'updated_at',
    ];



    /**
     * Get all of the post's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get all of the categories for the post.
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    /**
     * Get all of the post's galleries.
     */
    public function galleries()
    {
        return $this->morphMany(Gallery::class, 'gallerizable');
    }


    /**
     * @return mixed
     */
    function getDatePostAttribute(){
        return $this->translateDate($this->created_at->format('F d, Y'));
    }

    /**
     * @return mixed
     */
    function getShortDatePostAttribute(){
        return $this->translateDate($this->created_at->format('F Y'));
    }


    function getDayPostAttribute(){
        return $this->created_at->format('d');
    }

    function getMonthPostAttribute(){
        return $this->created_at->format('F');
    }

    /**
     * @return string
     */
    function getAuthorPostAttribute(){

        return ucfirst($this->author);
    }
    /**
     * @return string
     */
    function getShortContentAttribute(){
        return str::limit(
            $this->content, 45, ' (...)'
        );
    }

    /**
     * @return string
     */
    function getShortTitleAttribute(){
        return str::limit(
            $this->title, 15, '...'
        );
    }


    /**
     * @param $val
     */
    function setSlugTitleAttribute($val){
        $this->attributes['slug'] = Str::slug($val);
    }
}
