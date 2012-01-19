<?php

namespace Shop\OrderBundle\Service;

use \Doctrine\ORM\EntityManager,
    Shop\OrderBundle\Entity\Purchase,
    Shop\OrderBundle\Entity\PurchaseItem,
    Shop\ProductBundle\Entity\Tax,
    Shop\ProductBundle\Service\TaxService,
    Shop\ProductBundle\Entity\Product,        
    Shop\CartBundle\Model\Cart,
    Shop\MainBundle\Model\Money,
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
        $purchase->setDate(new DateTime());
        
        $this->setItemsForPurchase($cart->getItems(), $purchase);
        $this->setTotalsForPurchase($purchase);   
        
        $this->em->persist($purchase);
        $this->em->flush();
        
        return $purchase;
    }
    
    /**
     * @param  array    $items
     * @param  Purchase $purchase
     * @return OrderService 
     */
    protected function setItemsForPurchase(array $items, Purchase $purchase)
    {
        foreach($items as $cartItem) {
            $product = $cartItem->getProduct();
            $item    = new PurchaseItem($product);
            
            $item->setQuantity($cartItem->getQuantity());
            $item->setTax($this->taxService->getAmountOfTax($product));
            $item->setTaxPercent($this->taxService->getValidTax($product->getTax())->getPercent());
            $item->setPriceWithoutTax($this->taxService->untax($product));
            $item->setPriceWithTax($product->getPriceWithTax());
            
            $purchase->addItem($item);
            $this->em->persist($item);
        }
        
        return $this;
    }
    
    /**
     * @param  Purchase $purchase
     * @return OrderService 
     */
    protected function setTotalsForPurchase(Purchase $purchase)
    {
        $tax        = Money::create('0.00');
        $withoutTax = Money::create('0.00');
        $withTax    = Money::create('0.00');
        
        foreach($purchase->getItems() as $item) {
            for($i = 1; $i <= $item->getQuantity(); $i++) {
                $tax        = $tax->plus($item->getTax());
                $withoutTax = $withoutTax->plus($item->getPriceWithoutTax());
                $withTax    = $withTax->plus($item->getPriceWithTax());
            }
        }
        
        $purchase->setTotalWithoutTax($withoutTax);  
        $purchase->setTotalWithTax($withTax);  
        $purchase->setTotalTax($tax);
        
        return $this;
    }
}
