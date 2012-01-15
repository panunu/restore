<?php

namespace Shop\OrderBundle\Service;

use \Doctrine\ORM\EntityManager,
    Shop\OrderBundle\Entity\Purchase,
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
        $purchase = new Purchase();
        
        $this->countTotalsForPurchase($purchase);
        
        $purchase->setDate(new DateTime());
        
        $purchase->setProducts($cart->getProducts());
        
        $this->em->persist($purchase);
        $this->em->flush();
        
        return $purchase;
    }
    
    protected function countTotalsForPurchase(Purchase $purchase)
    {
        $purchase->setTotalTax(0.00);
        $purchase->setTotalWithoutTax(0.00);
        $purchase->setTotalWithTax(0.00);
        
        return $this;
    }
}