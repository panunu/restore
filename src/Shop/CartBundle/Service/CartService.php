<?php

namespace Shop\CartBundle\Service;

use \Symfony\Component\HttpFoundation\Session,
    Shop\CartBundle\Model\Cart,
    Shop\ProductBundle\Entity\Product,
    \DomainException;

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
        // TODO: Check if non-serializable Product is already ordered.
        if (!$product->getSerializable() && $this->getCart()->hasProduct($product)) {
            throw new DomainException('Unique product can not be ordered twice');
        }
        
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
     * @param  Product $product
     * @param  int     $quantity
     * @return CartService 
     */
    public function editProductInCart(Product $product, $quantity)
    {
        if (!$product->getSerializable() && $quantity > 1) {
            throw new DomainException('Unique product can not be ordered twice');
        }
        
        $this->getCart()->setProduct($product, (int) $quantity);
        
        return $this->flush();
    }
    
    /**
     * @return CartService
     */
    public function clearCart()
    {
        $this->cart = new Cart();
        
        return $this->flush();
    }
    
    /**
     * @return Cart
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
