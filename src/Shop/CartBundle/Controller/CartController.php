<?php

namespace Shop\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CartController extends Controller
{
    public function viewAction()
    {
        return $this->render('ShopCartBundle:Cart:view.html.twig', array(
            'cart' => $this->getCartService()->getCart()
        ));
    }
    
    /**
     * @return CartService
     */
    protected function getCartService()
    {
        return $this->get('shop_cart.service.cart');
    }
}