<?php


namespace App\Repositories\Eloquents;


use App\Models\StoreProduct;
use App\Repositories\Contracts\CartRepositoryContract;
use App\Services\ShoppingCartService;

class CartRepository implements CartRepositoryContract
{
    use ShoppingCartService;

    /**
     * @return mixed
     */
    public function getAll()
    {
        return \ShoppingCart::all()->map(function ($item){

            return (object)[
                'rawId' => $item->rawId(),
                'id'    => $item->storeproduct->id,
                'title' => $item->storeproduct->short_title_store_product,
                'price_with_devise' => $this->__priceItemWithDevise($item->storeproduct->price_cart, $item->storeproduct->devise),
                'price' => $this->__priceItem($item->storeproduct->price_cart, $item->storeproduct->devise),
                'image' => $item->storeproduct->image,
                'slug'  => $item->storeproduct->slug,
                'total' => $this->__totalWithDeviseByItem($item->total, $item->storeproduct->devise),
                'qty'   => $item->qty,
                'color' => $item->color,
                'size'  => $item->size,
            ];
        });
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id)
    {
        return \ShoppingCart::get($id);
    }

    /**
     * @return mixed
     */
    public function clean()
    {
        return \ShoppingCart::destroy();
    }

    /**
     * @param StoreProduct $storeProduct
     * @param $request
     * @return mixed
     */
    public function add(StoreProduct $storeProduct, $request)
    {
        \ShoppingCart::associate('App\Models\StoreProduct');

        return \ShoppingCart::add(

            $storeProduct->id,
            $storeProduct->title,
            $request->get('quantity'),
            $storeProduct->price_cart,
            [
                'color'  => $request->get('color'),
                'size'   => $request->get('size')
            ]
        );
    }

    /**
     * @return mixed
     */
    public function getTotals()
    {
        return $this->__totals(\ShoppingCart::all());
    }

    /**
     * @param float $tax
     * @return float
     */
    public function getTotalsAndTax(float $tax){

        return (float)($this->getTotals() + $tax);
    }

    /**
     * @param float $tax
     * @return string
     */
    public function getTotalsAndTaxWithDevise(float $tax){

        return $this->getTotalsAndTax($tax)." {$this->__outDevisePrice()}";
    }

    /**
     * @return mixed
     */
    public function getTotalsWithDevise()
    {
        return $this->__totalsWithDevise(\ShoppingCart::all());
    }

    /**
     * @return mixed
     */
    public function getCounter()
    {
        return \ShoppingCart::count($totalItems = true);
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function remove(string $id)
    {
        return \ShoppingCart::remove($id);
    }
}
