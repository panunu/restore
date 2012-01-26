<?php

namespace Shop\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProductController extends Controller
{
    public function indexAction()
    {
        return $this->render('ShopProductBundle:Product:index.html.twig', array(
            'products'   => $this->getProductService()->getAllProducts(),
            'categories' => $this->getCategoryService()->getVisibleCategories(),
            'brands'     => $this->getBrandService()->getAllBrands(),
        ));
    }
    
    public function listAction()
    {
        return $this->render('ShopProductBundle:Product:list.html.twig', array(
            'products' => $this->getProductService()->getFilteredProducts(
                $this->getRequest()->get('brand'),
                $this->getRequest()->get('category')
            )
        ));
    }
    
    public function viewAction()
    {
        return $this->render('ShopCartBundle:Cart:view.html.twig', array(
            'cart' => $this->getCartService()->getCart()
        ));
    }
        
    /**
     * @return ProductService
     */
    protected function getProductService()
    {
        return $this->get('shop_product.service.product');
    }
    
    /**
     * @return CategoryService
     */
    protected function getCategoryService()
    {
        return $this->get('shop_product.service.category');
    }
    
    /**
     * @return BrandService
     */
    protected function getBrandService()
    {
        return $this->get('shop_brand.service.brand');
    }
}