<?php


namespace App\Services;


use Illuminate\Support\Facades\Cookie;

trait ShoppingCartService
{
    /**
     * @param float $totalItem
     * @param string $devise
     * @return float|int
     */
    public function __total(float $totalItem, string $devise)
    {
        return CachingService::convertCurrency($totalItem, $devise);
    }

    public function __priceItem(float $priceItem, string $devise){

        return $this->FormatPrice(CachingService::convertCurrency($priceItem, $devise));
    }

    public function __priceItemWithDevise(float $priceItem, string $devise){

        return $this->__priceItem($priceItem, $devise)." {$this->__outDevisePrice()}";
    }


    /**
     * @param float $totalItem
     * @param string $devise
     * @return string
     */
    public function __totalWithDeviseByItem(float $totalItem, string $devise){

        return $this->__totalByItem($totalItem, $devise)." {$this->__outDevisePrice()}";
    }


    /**
     * @param $shoppingCart
     * @return string
     */
    public function __totalsWithDevise($shoppingCart){

        $out_devise = Cookie::get('devise');

        return $this->__totals($shoppingCart)." {$out_devise}";
    }


    /**
     * @param float $totalItem
     * @param string $devise
     * @return string
     */
    public function __totalByItem(float $totalItem, string $devise){

        return $this->FormatPrice($this->__total($totalItem, $devise));
    }

    /**
     * @param $shoppingCart
     * @return string
     */
    public function __totals($shoppingCart){

        $totals = 0;

        foreach ($shoppingCart as $item){

            $totals += $this->__total($item->total, $item->storeproduct->devise);
        }

        return $this->FormatPrice($totals);
    }

    /**
     * @return string
     */
    public function __outDevisePrice()
    {

        $devises = ['USD' => '$', 'EUR' => '€', 'XOF' => 'XOF', 'UAH' => '&#8372;', 'NGN' => '&#8358;'];

        $out_devise = Cookie::get('devise');

        return $devises[$out_devise];
    }

    /**
     * @param $price
     * @return string
     */
    protected function FormatPrice(float $price){

        return number_format(floatval($price), 2, '.', ' ');
    }
}
