<?php

namespace Shop\OrderBundle\Service;

use \Doctrine\ORM\EntityManager,
    Shop\OrderBundle\Entity\Purchase,
    Shop\OrderBundle\Entity\PurchaseItem,
    Shop\ProductBundle\Entity\Tax,
    Shop\ProductBundle\Service\TaxService,
    Shop\ProductBundle\Entity\Product,        
    Shop\CartBundle\Model\Cart,
    \DateTime,
    \Doctrine\ORM\EntityRepository;

class OrderService
{
    /**
     * @var EntityManager
     */
    protected $em;
        
    /**
     * @var TaxService
     */
    protected $taxService;
    
    /**
     * @param EntityManager $em
     * @param TaxService    $taxService
     */
    public function __construct(EntityManager $em, TaxService $taxService)
    {
        $this->em         = $em;
        $this->taxService = $taxService;
    }
    
    /**
     * @param  Cart $cart
     * @return Purchase 
     */
    public function order(Cart $cart)
    {
        $purchase = new Purchase();
        
        //$purchase->setProducts($cart->getProducts());        
        $this->setItemsForPurchase($cart->getProducts(), $purchase);
        
        $purchase->setTotalTax(0.00);
        $purchase->setTotalWithoutTax(0.00);
        $purchase->setTotalWithTax(0.00);
        
        $purchase->setDate(new DateTime());
        
        $this->em->persist($purchase);
        $this->em->flush();
        
        return $purchase;
    }
    
    protected function setItemsForPurchase(array $products, Purchase $purchase)
    {
        foreach($products as $product) {
            $item = new PurchaseItem($product);
            
            $item->setTax($this->taxService->tax($product));
            $item->setTaxPercent($this->taxService->getValidTax($product->getTax())->getPercent());
            $item->setPriceWithoutTax($product->getPrice());
            $item->setPriceWithTax(0.00);
            
            $purchase->addItem($item);
            $this->em->persist($item);
        }
    }
    
    protected function setTotalsForPurchase(Purchase $purchase)
    {
        foreach($purchase->getProducts() as $product) {
            $purchase->setTotalTax(
                $this->taxService->tax($product)->plus($purchase->getTotalTax())
            );
        }
        
        $purchase->setTotalTax(0.00);
        $purchase->setTotalWithoutTax(0.00);
        $purchase->setTotalWithTax(0.00);
        
        return $this;
    }
}