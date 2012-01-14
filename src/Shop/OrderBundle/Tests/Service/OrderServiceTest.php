<?php

namespace Shop\OrderBundle\Tests\Model;

use Shop\FrameworkBundle\Test\TestCase,
    Shop\OrderBundle\Service\OrderService,
    Shop\ProductBundle\Entity\Product,
    Shop\ProductBundle\Entity\Tax,
    Shop\CartBundle\Model\Cart,
    Shop\OrderBundle\Entity\Order,
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
        
        $this->getEntityManager()->flush();
    }
    
    /**
     * @test
     * @group service
     * @group order
     */
    public function createsOrderFromCart()
    {
        $cart  = new Cart();
        $order = $this->service->order($cart);
        
        $this->assertNotNull($order);
    }
}
