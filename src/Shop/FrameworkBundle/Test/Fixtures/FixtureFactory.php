<?php

namespace Shop\FrameworkBundle\Test\Fixtures;

use \Doctrine\ORM\EntityManager,
    Xi\Doctrine\Fixtures\FixtureFactory as BaseFixtureFactory,
    Xi\Doctrine\Fixtures\FieldDef;

class FixtureFactory extends BaseFixtureFactory
{
    public function __construct(EntityManager $em)
    {
        parent::__construct($em);
        
        $this->setEntityNamespace('Shop');
        $this->setUpFixtures();
    }
    
    /**
     * @return FixtureFactory 
     */
    protected function setUpFixtures()
    {
        $this->defineEntity('ProductBundle\Entity\Product', array(
            'name'  => FieldDef::sequence("Product %d"),
            'price' => 5.00,
        ));
        
        return $this;
    }
}