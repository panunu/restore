<?php

namespace Shop\CartBundle\Model;

use Shop\ProductBundle\Entity\Product;

class CartItem
{
    /**
     * @var Product
     */
    protected $product;
    
    /**
     * @var int
     */
    protected $quantity;
    
    /**
     * @param Product $product
     * @param int     $quantity 
     */
    public function __construct(Product $product, $quantity = 1)
    {
        $this->product  = $product;
        $this->quantity = $quantity;
    }
    
    /**
     * @return Product
     */
    public function getProduct()
    {
        return $this->product;
    }
    
    /** 
     * @return CartItem 
     */
    public function add()
    {
        $this->quantity++;
        
        return $this;
    }
    
    /** 
     * @return CartItem 
     */
    public function remove()
    {
        $this->quantity--;
        
        return $this;
    }
    
    /** 
     * @param  int $quantity
     * @return CartItem 
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        
        return $this;
    }
    
    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }
}
