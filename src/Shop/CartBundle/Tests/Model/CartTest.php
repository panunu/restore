<?php

namespace Shop\CartBundle\Tests\Model;

use Shop\FrameworkBundle\Test\TestCase,
    Shop\CartBundle\Model\Cart,
    \Shop\ProductBundle\Entity\Product;

/**
 * @group model
 * @group cart
 */
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
     */
    public function doesNotHaveItemsIfNothingAdded()
    {
        $this->assertEmpty($this->cart->getItems());
    }
    
    /**
     * @test
     */
    public function hasMultipleItems()
    {
        $this->cart->addProduct($this->product)
            ->addProduct($this->getFixtureFactory()->get('ProductBundle\Entity\Product'));
        
        $this->assertEquals(2, count($this->cart->getItems()));
    }
    
    /**
     * @test
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
     */
    public function removesItemIfQuantityReachesZero()
    {
        $this->cart->addProduct($this->product);
        $this->cart->removeProduct($this->product);
        
        $this->assertEmpty($this->cart->getItems());
    }
    
    /**
     * @test
     */
    public function countsTotalItemQuantity()
    {
        $product = $this->getFixtureFactory()->get('ProductBundle\Entity\Product', array(
            'priceWithTax' => '8.00'
        ));
        
        $this->getEntityManager()->flush();
        
        $this->cart->addProduct($this->product)->addProduct($this->product)
            ->addProduct($product);
        
        $this->assertEquals(3, $this->cart->getSize());
    }
    
    /**
     * @test
     */
    public function countsTotalPriceOfCart()
    {
        $product = $this->getFixtureFactory()->get('ProductBundle\Entity\Product', array(
            'priceWithTax' => '8.99'
        ));
        
        $this->getEntityManager()->flush();
        
        $this->cart->addProduct($this->product)->addProduct($this->product)
            ->addProduct($product)->addProduct($product);
        
        $this->assertEquals(
            '27.98',
            $this->cart->getTotalPrice()
        );
    }
    
    /**
     * @test
     */
    public function knowsIfHasProduct()
    {
        $this->assertFalse($this->cart->hasProduct($this->product));
                
        $this->cart->addProduct($this->product);
        $this->assertTrue($this->cart->hasProduct($this->product));
    }
}
