<?php

namespace Shop\ProductBundle\Service;

use \Doctrine\ORM\EntityManager,
    Shop\ProductBundle\Entity\Product,
    \DateTime,
    \Doctrine\ORM\EntityRepository;

class ProductService
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
     * @param  int     $id
     * @return Product
     */
    public function getProductById($id)
    {
        return $this->repository->find($id);
    }
    
    /**
     * @return array
     */
    public function getAllProducts()
    {
        return $this->repository->findAll();
    }
    
    /**
     * @param  string $brands
     * @param  string $categories 
     * @return array
     */
    public function getFilteredProducts($brands, $categories)
    {
        $brands     = explode('+', $brands);
        $categories = $categories ? explode('+', $categories) : array();
        
        return $this->repository->findByBrandsAndCategories($brands, $categories);
    }
}
