<?php

namespace Shop\ProductBundle\Service;

use \Doctrine\ORM\EntityManager,
    Shop\ProductBundle\Entity\Tax,
    Shop\ProductBundle\Entity\Product,
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
     * @return float
     */
    public function tax(Product $product)
    {
        $percent = $this->getValidTax($product->getTax())->getPercent();
        
        return $product->getPrice() * ($percent / 100);
    }
}
