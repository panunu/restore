<?php

namespace Shop\CartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/ostoskori")
 */
class CartController extends Controller
{
    /**
     * @Route("/", name="cart_view")
     */
    public function viewAction()
    {
        return $this->render('ShopCartBundle:Cart:view.html.twig', array(
            'cart'  => $this->getCartService()->getCart()
        ));
    }
    
    /**
     * @Route("/lisaa/{product}/", name="cart_add")
     */
    public function addAction($product)
    {
        $product = $this->getProductService()->getProductById($product);
        
        $this->getCartService()->addProductToCart($product);
        
        return new \Symfony\Component\HttpFoundation\Response('ok'); // TODO: Refactor, maybe JSON response?
    }
    
    /**
     * @Route("/poista/{product}/", name="cart_remove")
     */
    public function removeAction($product)
    {
        $product = $this->getProductService()->getProductById($product);
        
        $this->getCartService()->removeProductFromCart($product);
        
        return new \Symfony\Component\HttpFoundation\Response('ok'); // TODO: Refactor, maybe JSON response?
    }
    
    /**
     * @Route("/muokkaa/{product}/kpl/{quantity}/", name="cart_edit")
     */
    public function editAction($product, $quantity)
    {
        $product = $this->getProductService()->getProductById($product);
        
        $this->getCartService()->editProductInCart($product, $quantity);
        
        return new \Symfony\Component\HttpFoundation\Response('ok'); // TODO: Refactor, maybe JSON response?
    }
    
    /**
     * @Route("/tyhjenna/", name="cart_clear")
     */
    public function clearAction()
    {
        $this->getCartService()->clearCart();
        
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
     * @return ProductService
     */
    protected function getProductService()
    {
        return $this->get('shop_product.service.product');
    }
}