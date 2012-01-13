<?php

namespace Shop\CartBundle\Tests\Model;

use Shop\FrameworkBundle\Test\TestCase,
    Shop\CartBundle\Model\Cart,
    \Shop\ProductBundle\Entity\Product;

class CartTest extends TestCase
{
    /**
     * @var Cart
     */
    protected $cart;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->cart = new Cart();
    }

    /**
     * @test
     * @group model
     * @group cart
     */
    public function doesNotHaveProductsIfNothingAdded()
    {
        $this->assertEmpty($this->cart->getProducts());
    }
    
    /**
     * @test
     * @group model
     * @group cart
     */
    public function canHaveMultipleProducts()
    {
        $this->cart->addProduct(new Product())->addProduct(new Product());
        
        $this->assertEquals(2, count($this->cart->getProducts()));
    }
    
    /**
     * @test
     * @group model
     * @group cart
     */
    public function removesSingleProduct() // TODO: Refactor to use FixtureFactory.
    {
        $a = new Product();
        $b = new Product();
        
        $this->getEntityManager()->persist($a);
        $this->getEntityManager()->persist($b);
        $this->getEntityManager()->flush();
        
        $this->cart->addProduct($a)->addProduct($a)->addProduct($b);
        $this->cart->removeProduct($a);        
        
        $this->assertEquals(2, count($this->cart->getProducts()));
    }
}
