<?php

namespace Shop\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{
    /**
     * @Route("/tuotteet",                                     name="product_index")
     * @Route("/tuotteet/merkki/{brand}/kategoria/{category}", name="product_filter_both")
     * @Route("/tuotteet/merkki/{brand}",                      name="product_filter_brand")
     * @Route("/tuotteet/kategoria/{category}",                name="product_filter_category")
     */
    public function indexAction($brand = '+', $category = '+', $page = 1)
    {
        if(!$this->getRequest()->isXmlHttpRequest()) { 
            return $this->render('ShopProductBundle:Product:index.html.twig', array(
                'categories' => $this->getCategoryService()->getVisibleCategories(),
                'brands'     => $this->getBrandService()->getAllBrands(),                
                'products'   => $this->getProductService()->getFilteredProductPaginator($brand, $category, $page)
            ));
        }
        
        return $this->render('ShopProductBundle:Product:list.html.twig', array(
            'products' => $this->getProductService()->getFilteredProductPaginator(
                $brand, $category, $page
            )
        ));
    }
        
    public function viewAction()
    {
        
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