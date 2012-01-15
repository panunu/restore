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
        
        $purchase->setProducts($cart->getProducts());
        
        $this->countTotalsForPurchase($purchase);
        
        $purchase->setDate(new DateTime());
        
        
        $this->em->persist($purchase);
        $this->em->flush();
        
        return $purchase;
    }
    
    protected function countTotalsForPurchase(Purchase $purchase)
    {
        foreach($purchase->getProducts() as $product) {
            $purchase->setTotalTax($purchase->getTotalTax());
        }
        
        $purchase->setTotalTax(0.00);
        $purchase->setTotalWithoutTax(0.00);
        $purchase->setTotalWithTax(0.00);
        
        return $this;
    }
}