<?php

namespace Shop\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function listAction()
    {
        return $this->render('ShopProductBundle:Product:list.html.twig', array(
            
        ));
    }
    
    public function viewAction()
    {
        return $this->render('ShopCartBundle:Cart:view.html.twig', array(
            'cart'  => $this->getCartService()->getCart()
        ));
    }
        
    /**
     * @return ProductService
     */
    protected function getProductService()
    {
        return $this->get('shop_product.service.product');
    }
}