<?php

namespace Shop\ProductBundle\Service;

use \Doctrine\ORM\EntityManager,
    \Doctrine\ORM\EntityRepository,
    Shop\BrandBundle\Entity\Category;

class CategoryService
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
    public function getVisibleCategories()
    {
        return $this->repository->findBy(array('visible' => true));
    }
}
