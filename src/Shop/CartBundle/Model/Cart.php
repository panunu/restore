<?php

namespace Shop\CartBundle\Model;

use Shop\ProductBundle\Entity\Product;

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
    public function addProduct(Product $product)
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
