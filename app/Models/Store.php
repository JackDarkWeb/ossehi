<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $table = 'stores';

    public $timestamps = true;

    protected $guarded = [];


    /**
     * Get all of the store product's galleries.
     */
    public function store_products()
    {
        return $this->morphMany(StoreProduct::class, 'store_productable');
    }

    /**
     * Get the user that owns the store.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getSloganStoreAttribute(){
        return $this->slogan ?: 'Slogan of the boutique';
    }

    public function getImageStoreAttribute(){
        return $this->image ?: "https://images.caradisiac.com/images/2/0/1/9/92019/S0-Enquete-exclusive-Pieces-detachees-comment-bien-les-choisir-et-eviter-les-pieges-558130.jpg";
    }
}
