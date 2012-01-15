<?php

namespace Shop\OrderBundle\Tests\Model;

use Shop\FrameworkBundle\Test\TestCase,
    Shop\OrderBundle\Service\OrderService,
    Shop\ProductBundle\Entity\Product,
    Shop\ProductBundle\Entity\Tax,
    Shop\CartBundle\Model\Cart,
    Shop\OrderBundle\Entity\Purchase,
    \DateTime;

class OrderServiceTest extends TestCase
{
    /**
     * @var OrderService
     */
    protected $service;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->service = new OrderService(
            $this->getContainer()->get('doctrine.orm.entity_manager')
        );
        
        $this->cart    = new Cart();
        $this->product = $this->getFixtureFactory()->get('ProductBundle\Entity\Product');
        
        $this->getEntityManager()->flush();
        
        $this->cart->addProduct($this->product);
    }
    
    /**
     * @test
     * @group service
     * @group order
     */
    public function persistsPurchaseFromCart()
    {
        $this->assertEquals(1, $this->service->order($this->cart)->getId());
    }
    
    /**
     * @test
     * @group service
     * @group order
     */
    public function purchaseHasSameProductsAsCart()
    {
        $this->assertEquals(
            $this->cart->getProducts(),
            $this->service->order($this->cart)->getProducts()->toArray()
        );
    }
}
