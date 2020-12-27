<?php

namespace App\Models;

use App\Services\CachingService;
use App\Services\PostService;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Product extends Model
{
    use PostService;



    protected $table = 'products';

    public $timestamps = true;

    protected $guarded = [];

    protected $casts = [
        'created_at',
        'updated_at',
    ];



    public function getPriceProductAttribute()
    {
        return $this->FormatPrice(CachingService::convertCurrency($this->price, $this->devise));
    }

    /**
     * @return string
     */
    public function getPriceProductWithDeviseAttribute()
    {
        return $this->getPriceProductAttribute()." {$this->getOutDevisePriceAttribute()}";
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
        return $this->getPriceProductAttribute();
    }

    /**
     * @return string
     */
    public function getOriginalPriceWithDeviseAttribute(){

        return $this->getOriginalPriceAttribute()." {$this->getOutDevisePriceAttribute()}";
    }

    public function getOutDevisePriceAttribute(){

        $devises = ['USD' => '$', 'EUR' => '€', 'XOF' => 'XOF', 'UAH' => '&#8372;', 'NGN' => '&#8358;'];

        $out_devise = Cookie::get('devise');

        return $devises[$out_devise];

    }

    /**
     * Get all of the categories for the product.
     */
    public function categories()
    {
        return $this->morphToMany(Category::class, 'categorizable');
    }

    /**
     * @return BelongsTo
     */
    function sub_categories(){
        return $this->belongsTo(SubCategory::class, 'parent_id');
    }

    /**
     * Get the user that owns the product.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all of the product's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    /**
     * Get all of the product's galleries.
     */
    public function galleries()
    {
        return $this->morphMany(Gallery::class, 'gallerizable');
    }

    /**
     * @return mixed
     */
    public function getColorsProductAttribute(){
        return json_decode($this->colors, true);
    }

    /**
     * @return mixed
     */
    public function getBrandsProductAttribute(){
        return json_decode($this->brands, true);
    }
    /**
     * @return mixed
     */
    public function getSizesProductAttribute(){
        return json_decode($this->sizes, true);
    }

    /**
     * @return string
     */
    function getShortTitleProductAttribute(){
        return str::limit(
            $this->title, 15, '...'
        );
    }

    /**
     * @return string
     */
    function getShortDescriptionProductAttribute(){
        return str::limit(
            $this->description, 100, ' (...)'
        );
    }


    /**
     * @return mixed
     */
    function getDateProductAttribute(){
        return $this->translateDate($this->created_at->format('F d, Y'));
    }

    /**
     * @return mixed
     */
    function getShortDateProductAttribute(){
        return $this->translateDate($this->created_at->format('F Y'));
    }

    function getDayProductAttribute(){
        return $this->created_at->format('d');
    }

    function getMonthProductAttribute(){
        return $this->created_at->format('F');
    }

    /**
     * @param $price
     * @return string
     */
    protected function FormatPrice(float $price){

        return number_format(floatval($price), 2, '.', ' ');
    }

}
