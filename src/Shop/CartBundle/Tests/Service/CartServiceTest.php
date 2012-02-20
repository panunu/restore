<?php

namespace Shop\CartBundle\Tests\Model;

use Shop\FrameworkBundle\Test\TestCase,
    Shop\CartBundle\Model\Cart,
    Shop\CartBundle\Service\CartService,
    Shop\ProductBundle\Entity\Product;

/**
 * @group service
 * @group cart
 */
class CartServiceTest extends TestCase
{
    /**
     * @var CartService
     */
    protected $service;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->service = new CartService($this->getContainer()->get('session'));
        $this->product = $this->getFixtureFactory()->get('ProductBundle\Entity\Product');
        
        $this->getEntityManager()->flush();
    }
        
    /**
     * @test
     */
    public function knowsIfDoesNotHaveCartStoredInSession()
    {
        $this->assertFalse($this->service->hasCart());
    }
    
    /**
     * @test
     */
    public function addsProductToCart()
    {
        $this->service->addProductToCart($this->product);
        
        $this->assertEquals(
            array($this->product),
            $this->service->getCart()->getProducts()
        );
    }
    
    /**
     * @test
     */
    public function removesProductFromCart()
    {
        $this->service->addProductToCart($this->product)
            ->removeProductFromCart($this->product)
            ->addProductToCart($this->product);
        
        $items = $this->service->getCart()->getItems();
        
        $this->assertEquals(1, $items[$this->product->getId()]->getQuantity());
        $this->assertEquals(1, count($this->service->getCart()->getProducts()));
    }
    
    
    /**
     * @test
     * @expectedException        DomainException
     * @expectedExceptionMessage Unique product can not be ordered twice
     */
    public function canNotAddMultipleUniqueProductsToCart()
    {
        $product = $this->getFixtureFactory()->get('ProductBundle\Entity\Product', array(
            'serializable' => false,
            'customizable' => false,
        ));
        
        $this->getEntityManager()->flush();
        
        $this->service->addProductToCart($product)->addProductToCart($product);
    }
    
    /**
     * @test
     * @expectedException        DomainException
     * @expectedExceptionMessage Unique product can not be ordered twice
     */
    public function canNotEditMultipleUniqueProductsToCart()
    {
        $product = $this->getFixtureFactory()->get('ProductBundle\Entity\Product', array(
            'serializable' => false,
            'customizable' => false,
        ));
        
        $this->getEntityManager()->flush();
        
        $this->service->editProductInCart($this->product, 2);
    }
}
