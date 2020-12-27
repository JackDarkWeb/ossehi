<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingOrder extends Model
{
    public $timestamps = true;

    protected $table = "shipping_orders";

    protected $guarded = [];

    protected $casts = [
        'created_at',
        'updated_at',
    ];

    function getShippingProductAttribute(){

        return (object)(json_decode($this->product, true));
    }

    function getShippingAddressAttribute(){

        return (object)(json_decode($this->address, true));
    }
}
