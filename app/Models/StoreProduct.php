<?php

namespace App\Models;

use App\Services\CachingService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class StoreProduct extends Model
{
    protected $table = 'store_products';

    public $timestamps = true;

    protected $guarded = [];

    /**
     * @return string
     */
    public function getPriceStoreProductAttribute()
    {
        return $this->FormatPrice(CachingService::convertCurrency($this->price, $this->devise));
    }

    /**
     * @return string
     */
    public function getPriceStoreProductWithDeviseAttribute()
    {
        return $this->getPriceStoreProductAttribute()." {$this->getOutDevisePriceAttribute()}";
    }

    /**
     * @return string
     */
    public function getPriceDiscountAttribute(){

        return $this->FormatPrice(CachingService::convertCurrency($this->discount_price, $this->devise));
    }

    /**
     * @return string
     */
    public function getPriceDiscountWithDeviseAttribute(){

        return $this->getPriceDiscountAttribute()." {$this->getOutDevisePriceAttribute()}";
    }

    public function getOutDevisePriceAttribute(){

        $devises = ['USD' => '$', 'EUR' => '€', 'XOF' => 'XOF', 'UAH' => '&#8372;', 'NGN' => '&#8358;'];

        $out_devise = Cookie::get('devise');

        return $devises[$out_devise];

    }

    /**
     * @return float|int
     */
    public function getDiscountPercentAttribute(){

        if ($this->discount_price){

            $q = $this->FormatPrice($this->discount_price/$this->price);

            return $this->FormatPrice((1-$q)*100);
        }
        return 0;
    }

    /**
     * @return string
     */
    public function getOriginalPriceAttribute(){

        if ($this->discount_price){

            return $this->FormatPrice(CachingService::convertCurrency($this->discount_price, $this->devise));
        }
        return $this->getPriceStoreProductAttribute();
    }

    public function getPriceCartAttribute(){

        if ($this->discount_price){

            return $this->discount_price;
        }

        return $this->price;
    }

    /**
     * @return string
     */
    public function getOriginalPriceWithDeviseAttribute(){

        return $this->getOriginalPriceAttribute()." {$this->getOutDevisePriceAttribute()}";
    }


    /**
     * @return mixed
     */
    public function getColorsStoreProductAttribute(){
        return json_decode($this->colors, true);
    }


    /**
     * @return mixed
     */
    public function getBrandsStoreProductAttribute(){
        return json_decode($this->brands, true);
    }

    /**
     * @return mixed
     */
    public function getSizesStoreProductAttribute(){
        return json_decode($this->sizes, true);
    }

    /**
     * @return string
     */
    function getShortTitleStoreProductAttribute(){
        return str::limit(
            $this->title, 15, '...'
        );
    }

    /**
     * @return string
     */
    function getShortDescriptionStoreProductAttribute(){
        return str::limit(
            $this->description, 100, ' (...)'
        );
    }

    /**
     * Get the owning commentable model.
     */
    public function store_productable()
    {
        return $this->morphTo();
    }


    /**
     * Get all of the storeProduct's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get all of the store product's galleries.
     */
    public function galleries()
    {
        return $this->morphMany(Gallery::class, 'gallerizable');
    }


    /**
     * @param $price
     * @return string
     */
    protected function FormatPrice(float $price){

        return number_format(floatval($price), 2, '.', ' ');
    }
}
