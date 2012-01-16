<?php

namespace Shop\ProductBundle\Tests\Model;

use Shop\FrameworkBundle\Test\TestCase,
    Shop\ProductBundle\Service\TaxService,
    Shop\ProductBundle\Entity\Product,
    Shop\ProductBundle\Entity\Tax,
    \DateTime;

class TaxServiceTest extends TestCase
{
    /**
     * @var TaxService
     */
    protected $service;
    
    public function setUp()
    {
        parent::setUp();
        
        $this->service = new TaxService(
            $this->getContainer()->get('doctrine.orm.entity_manager'),
            $this->getContainer()->get('shop_product.repository.tax')
        );
        
        $this->product = $this->getFixtureFactory()->get('ProductBundle\Entity\Product');
        $this->tax     = $this->getFixtureFactory()->get('ProductBundle\Entity\Tax', array(
            'validity' => new DateTime('2000-01-01 00:00:00')
        ));
        
        $this->getEntityManager()->flush();
    }
    
    /**
     * @test
     * @group service
     * @group tax
     */
    public function getsCorrectTaxForGivenTypeAndDate()
    {
        $valid = $this->getFixtureFactory()->get('ProductBundle\Entity\Tax', array(
            'validity' => new DateTime('2001-01-02 00:00:00')
        ));
        
        $this->getEntityManager()->flush();
        
        $this->assertEquals(
            $valid,
            $this->service->getTax(Tax::TYPE_GENERAL, new DateTime('2002-10-10'))                
        );
    }
    
    /**
     * @test
     * @group service
     * @group tax
     */
    public function getsCorrectTaxIfTheGivenDateIsSameAsTheTaxValidityDate()
    {
        $this->assertEquals(
            $this->tax,
            $this->service->getTax(Tax::TYPE_GENERAL, new DateTime('2000-01-01'))                
        );
    }
    
    /**
     * @test
     * @group service
     * @group tax
     */
    public function getsNullIfNoTaxWasSetBeforeGivenDate()
    {
        $this->assertNull(
            $this->service->getTax(Tax::TYPE_GENERAL, new DateTime('1999-01-01'))
        );
    }
    
    /**
     * @test
     * @group service
     * @group tax
     */
    public function getsValidTax()
    {
        $this->assertEquals(
            $this->tax,
            $this->service->getValidTax(Tax::TYPE_GENERAL)                
        );
    }
    
    /**
     * @test
     * @group service
     * @group tax
     */
    public function calculatesTaxForProduct()
    {
        $product = $this->getFixtureFactory()->get('ProductBundle\Entity\Product', array(
            'price' => 19.93
        ));
        
        $tax = $this->getFixtureFactory()->get('ProductBundle\Entity\Tax', array(
            'percent'  => 23.05,
            'validity' => new DateTime('2000-01-02')
        ));
        
        $this->getEntityManager()->flush();
        
        $this->assertEquals(
            '4.59', // round(19.93 * 0.2305, 2)
            $this->service->tax($product)->toString()
        );
    }
}
