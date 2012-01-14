<?php

namespace Shop\CartBundle\Tests\Model;

use Shop\FrameworkBundle\Test\TestCase,
    Shop\OrderBundle\Service\OrderService,
    Shop\ProductBundle\Entity\Product,
    Shop\ProductBundle\Entity\Tax,
    Shop\OrderBundle\Entity\Order,
    \DateTime;

class TaxServiceTest extends TestCase
{
    /**
     * @var CartService
     */
    protected $service;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->service = new TaxService(
            $this->getContainer()->get('doctrine.orm.entity_manager')
        );
        
        $this->getEntityManager()->flush();
    }
}
