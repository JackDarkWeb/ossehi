<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SubCategory extends Model
{
    protected $table = "sub_categories";


    public $timestamps = true;


    protected $guarded = [];

    protected $casts = [
        'created_at',
        'updated_at',
    ];

    /**
     * Get the category that owns the subcategory.
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * @return HasMany
     */
    function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * @return string
     */
    function getSubCategoryNameAttribute()
    {
        return ucfirst($this->name);
    }
}
