<?php

namespace Shop\ProductBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class ProductController extends Controller
{
    /**
     * @Route("/tuotteet/", name="product_index")
     * @Route("/tuotteet/merkki/{brand}", name="product_filter_brand")
     * @Route("/tuotteet/kategoria/{category}", name="product_filter_category")
     * @Route("/tuotteet/merkki/{brand}/kategoria/{category}", name="product_filter_both")
     */
    public function indexAction($brand = '+', $category = '+')
    {
        $page = $this->getRequest()->get('page') ?: 1;
        
        $this->getHistoryService()->saveUrl($this->getRequest()->getRequestUri());
        
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
    
    /**
     * @Route("/tuote/{slug}/", name="product_view")
     */
    public function viewAction($slug)
    {
        return $this->render('ShopProductBundle:Product:view.html.twig', array(
            'product' => $this->getProductService()->getProductBySlug($slug),
            'history' => $this->getHistoryService()->getUrl()
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
    
    /**
     * @return HistoryService
     */
    protected function getHistoryService()
    {
        return $this->get('shop_product.service.history');
    }
}