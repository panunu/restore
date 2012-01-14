<?php

namespace Shop\OrderBundle\Service;

use \Doctrine\ORM\EntityManager,
    Shop\OrderBundle\Entity\Order,
    Shop\ProductBundle\Entity\Tax,
    Shop\CartBundle\Model\Cart,
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
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    public function order(Cart $cart)
    {
        
    }
}
