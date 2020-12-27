<?php

namespace App\Models;

use App\Services\CachingService;
use App\Services\PostService;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class Various extends Model
{
    use PostService;



    protected $table = 'variouses';

    public $timestamps = true;

    protected $guarded = [];


    /**
     * @return string|null
     */
    public function getPriceVariousAttribute()
    {
        if ($this->price)

            return $this->FormatPrice(CachingService::convertCurrency($this->price, $this->devise));

        return null;
    }


    /**
     * @return string|null
     */
    public function getPriceVariousWithDeviseAttribute()
    {
        if ($this->getPriceVariousAttribute())

            return $this->getPriceVariousAttribute()." {$this->getOutDevisePriceAttribute()}";

        return null;
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
        return $this->getPriceVariousAttribute();
    }

    /**
     * @return string
     */
    public function getOriginalPriceWithDevise(){

        return $this->getOriginalPriceAttribute()." {$this->getOutDevisePriceAttribute()}";
    }


    public function getOutDevisePriceAttribute(){

        $devises = ['USD' => '$', 'EUR' => '€', 'XOF' => 'XOF', 'UAH' => '&#8372;', 'NGN' => '&#8358;'];

        $out_devise = Cookie::get('devise');

        return $devises[$out_devise];

    }

    /**
     * @return mixed
     */
    function getDateVariousAttribute(){
        return $this->translateDate($this->created_at->format('F d, Y'));
    }

    /**
     * @return mixed
     */
    function getShortDateVariousAttribute(){
        return $this->translateDate($this->created_at->format('F Y'));
    }

    function getDayVariousAttribute(){
        return $this->created_at->format('d');
    }

    function getMonthVariousAttribute(){
        return $this->created_at->format('F');
    }

    /**
     * @return string
     */
    function getShortTitleVariousAttribute(){
        return str::limit(
            $this->title, 15, '...'
        );
    }

    /**
     * @return string
     */
    function getShortDescriptionVariousAttribute(){
        return str::limit(
            $this->description, 100, ' (...)'
        );
    }


    /**
     * Get all of the storeProduct's comments.
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Get all of the various galleries.
     */
    public function galleries()
    {
        return $this->morphMany(Gallery::class, 'gallerizable');
    }

    /**
     * Get the user that owns the various.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @param $price
     * @return string
     */
    protected function FormatPrice(float $price){

        return number_format(floatval($price), 2, '.', ' ');
    }

}
