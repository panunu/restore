<?php

namespace Shop\CartBundle\Model;

use Shop\ProductBundle\Entity\Product;

class Cart
{
    /**
     * @var array
     */
    protected $items = array();
    
    /**
     * @param  Product $product 
     * @return Cart
     */
    public function addProduct(Product $product)
    {                
        if(array_key_exists($product->getId(), $this->items)) {
            $this->items[$product->getId()]->add();
        } else {
            $this->items[$product->getId()] = new CartItem($product);
        }
        
        return $this;
    }
    
    /**
     * @param  Product $product 
     * @return Cart
     */
    public function removeProduct(Product $product)
    {
        if(array_key_exists($product->getId(), $this->items)) {
            $this->items[$product->getId()]->remove();
            return $this->unsetItemIfEmpty($product->getId());
        }
        
        return $this;
    }
    
    /**
     * @param  CartItem $item
     * @param  int      $id
     * @return Cart 
     */
    protected function unsetItemIfEmpty($id)
    {
        if($this->items[$id]->getQuantity() < 1) {
            unset($this->items[$id]);
        }
        
        return $this;
    }
    
    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }
    
    /**
     * @return array
     */
    public function getProducts()
    {
        return array_values(array_map(
            function($item) { return $item->getProduct(); },
            $this->items
        ));
    }
}
