<?php

namespace Shop\CartBundle\Model;

class Cart
{
    /**
     * @var array
     */
    protected $products;
    
    /**
     * @param  Product $product 
     * @return Cart
     */
    public function addProduct($product)
    {
        $this->products[] = $product;
        
        return $this;
    }
    
    /**
     * @return array
     */
    public function getProducts()
    {
        return $this->products;
    }
}
