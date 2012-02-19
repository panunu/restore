<?php

namespace Shop\FrameworkBundle\Test\Fixtures;

use \Doctrine\ORM\EntityManager,
    Xi\Doctrine\Fixtures\FixtureFactory as BaseFixtureFactory,
    Xi\Doctrine\Fixtures\FieldDef,
    \Shop\ProductBundle\Entity\Tax,
    \DateTime;

class FixtureFactory extends BaseFixtureFactory
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        
        $this->setEntityNamespace('Shop');
        $this->setUpFixtures();
        $this->persistOnGet();
    }
    
    /**
     * @return FixtureFactory 
     */
    protected function setUpFixtures()
    {
        $this->defineEntity('ProductBundle\Entity\Tax', array(
            'type'     => Tax::TYPE_GENERAL,
            'percent'  => 23.00,
            'validity' => new DateTime('2000-01-01')
        ));
        
        $this->defineEntity('ProductBundle\Entity\Product', array(
            'name'         => FieldDef::sequence("Product %d"),
            'priceWithTax' => 5.00,
            'tax'          => Tax::TYPE_GENERAL,
            'brand'        => FieldDef::reference('BrandBundle\Entity\Brand'),
            'category'     => FieldDef::reference('ProductBundle\Entity\Category'),
        ));
        
        $this->defineEntity('BrandBundle\Entity\Brand', array(
            'name' => FieldDef::sequence("Brand %d"),
            'slug' => FieldDef::sequence("brand-%d"),
        ));
        
        $this->defineEntity('ProductBundle\Entity\Category', array(
            'name'    => FieldDef::sequence("Category %d"),
            'slug'    => FieldDef::sequence("category-%d"),
            'visible' => true,
        ));
        
        return $this;
    }
}