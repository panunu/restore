<?php

namespace Shop\CartBundle\Service;

use \Symfony\Component\HttpFoundation\Session,
    Shop\CartBundle\Model\Cart,
    Shop\ProductBundle\Entity\Product;

class CartService
{
    /**
     * @var Session
     */
    protected $session;
    
    /**
     * @var Cart
     */
    protected $cart;
    
    /**
     * @param Session $session 
     */
    public function __construct(Session $session)
    {
        $this->session = $session;
    }
    
    /**
     * @param  Product $product
     * @return CartService 
     */
    public function addProductToCart(Product $product)
    {
        $this->getCart()->addProduct($product);
                
        return $this->flush();
    }
    
    /**
     * @param  Product $product
     * @return CartService 
     */
    public function removeProductFromCart(Product $product)
    {
        $this->getCart()->removeProduct($product);
                
        return $this->flush();
    }
    
    /**
     * @return int
     */
    public function getNumberOfProductsInCart()
    {
        return count($this->getCart()->getProducts());
    }
    
    /**
     * @return double
     */
    public function getTotalSumOfCart()
    {
        return array_reduce($this->getCart()->getProducts(), function($total, $product) {
            return $total += $product->getPrice();
        }, 0);
    }
    
    /**
     * @return Cart|null
     */
    public function getCart()
    {
        return $this->cart = $this->session->get('cart') ?: new Cart();
    }
    
    /**
     * @return boolean
     */
    public function hasCart()
    {
        return $this->session->get('cart') != null;
    }
    
    /**
     * Flushes the session, persisting possible changes to Cart.
     * 
     * @return CartService
     */
    protected function flush()
    {
        $this->session->set('cart', $this->cart);
        
        return $this;
    }
}
