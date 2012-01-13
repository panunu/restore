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
     * @param  Product $product 
     * @return Cart
     */
    public function removeProduct(Product $product)
    {
        foreach($this->products as $key => $value) {
            if($value === $product) {
                unset($this->products[$key]);
                return $this;
            }
        }
        
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
