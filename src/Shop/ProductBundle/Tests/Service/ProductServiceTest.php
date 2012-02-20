<?php

namespace Shop\ProductBundle\Tests\Service;

use Shop\FrameworkBundle\Test\TestCase,
    Shop\ProductBundle\Service\ProductService,
    Shop\ProductBundle\Entity\Product,
    Shop\ProductBundle\Entity\Tax,
    \DateTime;

/**
 * @group service
 * @group product
 */
class ProductServiceTest extends TestCase
{
    /**
     * @var ProductService
     */
    protected $service;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->service = new ProductService(
            $this->getContainer()->get('doctrine.orm.entity_manager'),
            $this->getContainer()->get('shop_product.repository.product'),
            $this->getContainer()->get('knp_paginator'),
            $this->getContainer()->get('form.factory')
        );
        
        $this->tax = $this->getFixtureFactory()->get('ProductBundle\Entity\Tax', array(
            'validity' => new DateTime('2000-01-01 00:00:00')
        ));
        
        $this->brand    = $this->getFixtureFactory()->get('BrandBundle\Entity\Brand');
        $this->category = $this->getFixtureFactory()->get('ProductBundle\Entity\Category');
        
        $this->getEntityManager()->flush();
    }
    
    /**
     * @test
     */
    public function savesProduct()
    {
        $product = $this->createProduct();        
        $this->service->saveProduct($product);
        
        $this->getEntityManager()->refresh($product);
                
        $this->assertNotNull($product->getId());
    }
    
    /**
     * @return Product 
     */
    protected function createProduct()
    {
        $product = new Product();
        $product->setName('A');
        $product->setBrand($this->brand);
        $product->setCategory($this->category);
        $product->setPriceWithTax('1.00');
        $product->setTax($this->tax->getType());
        $product->setSerializable(false);
        $product->setCustomizable(false);
        
        return $product;
    }
}
