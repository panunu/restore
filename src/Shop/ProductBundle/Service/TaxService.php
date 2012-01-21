<?php

namespace Shop\ProductBundle\Service;

use \Doctrine\ORM\EntityManager,
    Shop\ProductBundle\Entity\Tax,
    Shop\ProductBundle\Entity\Product,
    Shop\MainBundle\Model\Money,
    \DateTime,
    \Doctrine\ORM\EntityRepository;

class TaxService
{
    /**
     * @var EntityManager
     */
    protected $em;
    
    /**
     * @var TaxRepository
     */
    protected $repository;
    
    /**
     * @param EntityManager    $em
     * @param EntityRepository $repository
     */
    public function __construct(EntityManager $em, EntityRepository $repository)
    {
        $this->em         = $em;
        $this->repository = $repository;
    }
    
    /**
     * @param  int      $type
     * @param  DateTime $date 
     * @return Tax
     */
    public function getTax($type, $date)
    {
        return $this->repository->findByTypeAndDate($type, $date);
    }
    
    /**
     * @param  int $type
     * @return Tax
     */
    public function getValidTax($type)
    {
        return $this->repository->findByTypeAndDate($type, new DateTime());
    }
    
    /**
     * @param  Product $product 
     * @return Money
     */
    public function getAmountOfTax(Product $product)
    {
        $percent = $this->getValidTax($product->getTax())->getPercent() / 100;
        $price   = Money::create($product->getPriceWithTax());
        
        return $price->div(1 + ($percent))->times($percent)->round();
    }
    
    /**
     * @param  Product $product 
     * @return Money
     */
    public function untax(Product $product)
    {
        $price = Money::create($product->getPriceWithTax());
        
        return $price->minus($this->getAmountOfTax($product))->round();
    }
}
