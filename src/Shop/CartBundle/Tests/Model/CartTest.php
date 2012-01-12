<?php

namespace Shop\CartBundle\Tests\Model;

use \PHPUnit_Framework_TestCase,
    Shop\CartBundle\Model\Cart;

class CartTest extends PHPUnit_Framework_TestCase
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
        $this->cart->addProduct('A')->addProduct('B');
        
        $this->assertEquals(2, count($this->cart->getProducts()));
    }
}
