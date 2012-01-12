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
        
    }
}
