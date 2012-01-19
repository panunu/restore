<?php

namespace Shop\OrderBundle\Tests\Model;

use Shop\FrameworkBundle\Test\TestCase,
    Shop\OrderBundle\Service\OrderService,
    Shop\ProductBundle\Entity\Product,
    Shop\ProductBundle\Entity\Tax,
    Shop\CartBundle\Model\Cart,
    Shop\OrderBundle\Entity\Purchase,
    Shop\MainBundle\Model\Money,
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
            $this->getContainer()->get('doctrine.orm.entity_manager'),
            $this->getContainer()->get('shop_product.service.tax')
        );
                
        $this->product = $this->getFixtureFactory()->get('ProductBundle\Entity\Product', array(
            'priceWithTax' => 8.00
        ));
        
        $this->tax = $this->getFixtureFactory()->get('ProductBundle\Entity\Tax', array(
            'validity' => new DateTime('2000-01-02'),
            'percent'  => 23.00
        ));
        
        $this->getEntityManager()->flush();
        
        $this->cart = new Cart();
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
            $this->service->order($this->cart)->getProducts()
        );
    }
    
    /**
     * @test
     * @group service
     * @group order
     */
    public function purchaseItemHasTaxAndTaxPercent()
    {
        $order = $this->service->order($this->cart);
        $item  = $order->getItems()->first();
        
        $this->assertMoneyEquals('1.50', $item->getTax());        
        $this->assertEquals('23.00', $item->getTaxPercent());
    }
    
    /**
     * @test
     * @group service
     * @group order
     */
    public function purchaseItemHasPriceWithoutAndWithTax()
    {
        $order = $this->service->order($this->cart);
        $item  = $order->getItems()->first();
        
        $this->assertMoneyEquals('5.51', $item->getPriceWithoutTax());
        $this->assertMoneyEquals('6.78', $item->getPriceWithTax());
    }
    
    /**
     * @test
     * @group service
     * @group order
     */
    public function purchaseItemHasQuantity()
    {
        $order = $this->service->order($this->cart->addProduct($this->product));
        $item  = $order->getItems()->first();
        
        $this->assertEquals(2, $item->getQuantity());
    }
    
    /**
     * @test
     * @group service
     * @group order
     */
    public function purchaseHasTotalTaxesAndPrices()
    {
        $this->cart->addProduct($this->product);
        
        $order = $this->service->order($this->cart);
        
        $this->assertMoneyEquals('2.54',  $order->getTotalTax());
        $this->assertMoneyEquals('11.02', $order->getTotalWithoutTax());
        $this->assertMoneyEquals('13.56', $order->getTotalWithTax());
    }    
    
    /**
     * @param string $expected
     * @param Money  $actual 
     */
    protected function assertMoneyEquals($expected, $actual)
    {
        $this->assertEquals(
            $expected,
            $actual instanceof Money ? $actual->toString() : $actual
        );
    }
}
