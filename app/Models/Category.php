<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    public $timestamps = true;

    protected $table = 'categories';

    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at'
    ];


    /**
     * Get all of the posts that are assigned this category.
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'categorizable');
    }

    /**
     * Get all of the products that are assigned this category.
     */
    public function products()
    {
        return $this->morphedByMany(Product::class, 'categorizable');
    }


    /**
     * Get the subcategories for the category.
     */
    public function sub_categories()
    {
        return $this->hasMany(SubCategory::class);
    }

    /**
     * @return string
     */
    public function getCategoryNameAttribute(){
        return ucfirst($this->name);
    }

}
