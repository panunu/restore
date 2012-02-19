<?php

namespace Shop\ProductBundle\Controller;

use Shop\FrameworkBundle\Controller\Controller,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Route,
    Sensio\Bundle\FrameworkExtraBundle\Configuration\Method,
    Shop\ProductBundle\Entity\Product;

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
        
        if (!$this->getRequest()->isXmlHttpRequest()) { 
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
     * @Route("/hallinta/tuote/{slug}/", name="product_edit")
     */
    public function editAction($slug)
    {
        $self    = $this;
        $product = $this->getProductService()->getProductBySlug($slug);
        $form    = $this->getProductService()->getProductForm($product);
        
        $this->handleForm($form, function($form) use($self, $product) {
            $self->getProductService()->saveProductByForm($form);      
            
            $self->notify('Product saved');
            
            return $self->redirect($self->generateUrl(
                'product_edit', array('slug' => $product->getSlug())
            ));
        });
        
        return $this->render('ShopProductBundle:Product:edit.html.twig', array(
            'product' => $product,
            'form'    => $form->createView()
        ));
    }
    
    /**
     * @Route("/hallinta/tuote/", name="product_new")
     */
    public function newAction()
    {
        $self = $this;
        $form = $this->getProductService()->getProductForm(new Product());
        
        $this->handleForm($form, function($form) use($self) {
            $self->getProductService()->saveProductByForm($form);
            
            $self->notify('New product saved');
            
            return $self->redirect($self->generateUrl(
                'product_edit', array('slug' => $form->getData()->getSlug())
            ));
        });
        
        return $this->render('ShopProductBundle:Product:new.html.twig', array(
            'form' => $form->createView()
        ));
    }
    
    /**
     * @return ProductService
     */
    public function getProductService()
    {
        return $this->get('shop_product.service.product');
    }
    
    /**
     * @return CategoryService
     */
    public function getCategoryService()
    {
        return $this->get('shop_product.service.category');
    }
    
    /**
     * @return BrandService
     */
    public function getBrandService()
    {
        return $this->get('shop_brand.service.brand');
    }
    
    /**
     * @return HistoryService
     */
    public function getHistoryService()
    {
        return $this->get('shop_product.service.history');
    }
}