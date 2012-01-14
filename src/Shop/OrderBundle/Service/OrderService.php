<?php

namespace Shop\ProductBundle\Service;

use \Doctrine\ORM\EntityManager,
    Shop\OrderBundle\Entity\Order,
    Shop\ProductBundle\Entity\Tax,
    Shop\ProductBundle\Entity\Product,
    \DateTime,
    \Doctrine\ORM\EntityRepository;

class OrderService
{
    /**
     * @var EntityManager
     */
    protected $em;
        
    /**
     * @param EntityManager    $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
}
