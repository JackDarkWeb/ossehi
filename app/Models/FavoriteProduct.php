<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FavoriteProduct extends Model
{
    public $timestamps = true;

    protected $table = "favorite_products";

    protected $fillable = [
        'user_favorite_id',
        'product_id',
        'product',
    ];

    protected $casts = [
        'created_at',
        'updated_at',
    ];

    function getFavoriteProductAttribute(){
        return (object)json_decode(json_decode($this->product, true), true);
    }

    /**
     * @return string
     */
    static function getUserFavoriteId()
    {
        $id = Str::random();

        if(self::where('user_favorite_id', $id)->count()!= 0)
        {
            return self::getUserFavoriteId();
        }
        return $id;
    }
}
