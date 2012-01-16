<?php

namespace Shop\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CartController extends Controller
{
    public function viewAction()
    {
        return $this->render('ShopCartBundle:Cart:view.html.twig', array(
            'cart' => $this->getCartService()->getCart() // TODO: Transfer into Model that contains totals etc.
        ));
    }
    
    public function addAction($product)
    {
        $product = $this->getProductService()->getProductById($product);
        
        $this->getCartService()->addProductToCart($product);
        
        return new \Symfony\Component\HttpFoundation\Response('ok'); // TODO: Refactor, maybe JSON response?
    }
    
    /**
     * @return CartService
     */
    protected function getCartService()
    {
        return $this->get('shop_cart.service.cart');
    }
    
    /**
     * @return CartService
     */
    protected function getProductService()
    {
        return $this->get('shop_product.service.product');
    }
}