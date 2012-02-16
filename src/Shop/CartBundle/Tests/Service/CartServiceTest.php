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
        
        $this->getEntityManager()->flush();
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
    public function removesProductFromCart()
    {
        $this->service->addProductToCart($this->product)
            ->addProductToCart($this->product)
            ->addProductToCart($this->product)
            ->removeProductFromCart($this->product);
        
        $items = $this->service->getCart()->getItems();
        
        $this->assertEquals(2, $items[$this->product->getId()]->getQuantity());
        $this->assertEquals(1, count($this->service->getCart()->getProducts()));
    }
}
