<?php

namespace Shop\CartBundle\Tests\Model;

use Shop\FrameworkBundle\Test\TestCase,
    Shop\CartBundle\Model\Cart,
    Shop\CartBundle\Service\CartService,
    Shop\ProductBundle\Entity\Product;

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
    }
        
    /**
     * @test
     * @group service
     * @group cart
     */
    public function knowsIfDoesNotHaveCartStoredInSession()
    {
        $this->assertFalse($this->service->hasCart());
    }
    
    /**
     * @test
     * @group service
     * @group cart
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
     * @group service
     * @group cart
     */
    public function removesProductToCart()
    {
        $this->service->addProductToCart($this->product)
            ->addProductToCart($this->product)
            ->removeProductFromCart($this->product);
        
        $this->assertEquals(
            1,
            count($this->service->getCart()->getProducts())
        );
    }
    
    /**
     * @test
     * @group service
     * @group cart
     */
    public function countsProductsInCart()
    {
        $this->service->addProductToCart($this->product)
            ->addProductToCart($this->product);
        
        $this->assertEquals(
            2,
            $this->service->getNumberOfProductsInCart()
        );
    }
    
    /**
     * @test
     * @group service
     * @group cart
     */
    public function countTotalSumOfCart()
    {
        $product = $this->getFixtureFactory()->get(
            'ProductBundle\Entity\Product',
            array('price' => 16.93)
        );
        
        $this->service->addProductToCart($product)
            ->addProductToCart($product);
        
        $this->assertEquals(16.93 + 16.93, $this->service->getTotalSumOfCart());
    }
}
