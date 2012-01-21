<?php

namespace Shop\CartBundle\Twig\Extensions\Extension;

use \Twig_Extension,
    \Twig_Filter_Method,
    Shop\CartBundle\Model\Cart as ShoppingCart,
    Shop\CartBundle\Service\CartService;

class Cart extends Twig_Extension
{
    /**
     * @var CartService
     */
    protected $service;
    
    public function __construct(CartService $service)
    {        
        $this->service = $service;
    }
    
    /**
     * @return array
     */
    public function getFunctions()
    {
        return array('cart' => 
            new \Twig_Function_Method($this, 'cart', array('is_safe' => array('html')))
        );
    }
    
    /**
     * @return CartService
     */
    public function cart()
    {
        return $this->service->getCart();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cart_extension';
    }
}