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
        
        $this->product = $this->getFixtureFactory()->get('ProductBundle\Entity\Product');
        $this->cart    = new Cart();
        
        $this->getEntityManager()->flush();
    }

    /**
     * @test
     * @group model
     * @group cart
     */
    public function doesNotHaveItemsIfNothingAdded()
    {
        $this->assertEmpty($this->cart->getItems());
    }
    
    /**
     * @test
     * @group model
     * @group cart
     */
    public function hasMultipleItems()
    {
        $this->cart->addProduct($this->product)
            ->addProduct($this->getFixtureFactory()->get('ProductBundle\Entity\Product'));
        
        $this->assertEquals(2, count($this->cart->getItems()));
    }
    
    /**
     * @test
     * @group model
     * @group cart
     */
    public function itemsHaveQuantityAndProduct()
    {
        $this->cart->addProduct($this->product)->addProduct($this->product);
        
        $items = $this->cart->getItems();
        $item  = $items[$this->product->getId()];
        
        $this->assertEquals(2,              $item->getQuantity());
        $this->assertEquals($this->product, $item->getProduct());
    }    
    
    /**
     * @test
     * @group model
     * @group cart
     */
    public function decreasesQuantityOfItem()
    {
        $this->cart->addProduct($this->product)
            ->addProduct($this->product)
            ->addProduct($this->getFixtureFactory()->get('ProductBundle\Entity\Product'));
        
        $this->getEntityManager()->flush();
        
        $this->cart->removeProduct($this->product); 
        
        $items = $this->cart->getItems();
        $item  = $items[$this->product->getId()];
        
        $this->assertEquals(1, $item->getQuantity());
    }
    
    /**
     * @test
     * @group model
     * @group cart
     */
    public function removesItemIfQuantityReachesZero()
    {
        $this->cart->addProduct($this->product);
        $this->cart->removeProduct($this->product);
        
        $this->assertEmpty($this->cart->getItems());
    }
}
