<?php

namespace Shop\BrandBundle\Service;

use \Doctrine\ORM\EntityManager,
    \Doctrine\ORM\EntityRepository,
    Shop\BrandBundle\Entity\Brand;

class BrandService
{
    /**
     * @var EntityManager
     */
    protected $em;
    
    /**
     * @var ProductRepository
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
     * @return array
     */
    public function getAllBrands()
    {
        return $this->repository->findAll();
    }
}
