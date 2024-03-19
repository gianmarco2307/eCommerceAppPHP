<?php
class ECommerce{
    private $products = [];
    private $cart = [];

    private $url;
    private $data;

    private function getProductsFromAPI(){
        $this->url = "https://mockend.up.railway.app/api/products";
        $response = file_get_contents($this->url);
        $this->data = json_decode($response, true);
        $this->products = $this->data;
    }

    public function __construct(){
        $this->getProductsFromAPI();
    }

    public function getProducts(){
        return $this->products;
    }

    public function getCart(){
        return $this->cart;
    }

    public function addToCart($product, $quantityToBuy){
        $productToAdd = (object)[
            "product" => $product,
            "quantityToBuy" => $quantityToBuy
        ];

        $newCart = $this->cart;
        array_push($newCart, $productToAdd);
        $this->cart = $newCart;
    }

    public function updateCart($product, $quantityToBuy){
        $newCart = $this->cart;
        foreach($newCart as $key => $cartItem){
            if($cartItem->product->id == $product->id){
                $cartItem->quantityToBuy = $quantityToBuy;
                break;
            }
        }
        $this->cart = $newCart;
    }

    public function removeFromCart($product){
        $newCart = $this->cart;
        foreach($newCart as $key => $cartItem){
            if($cartItem->product->id == $product->id){
                unset($newCart[$key]);
                break;
            }
        }
        $this->cart = $newCart;
    }
}