<?php

namespace Shop\ProductBundle\Service;

use \Doctrine\ORM\EntityManager,
    Shop\ProductBundle\Entity\Product,
    \DateTime,
    \Doctrine\ORM\EntityRepository,
    Knp\Component\Pager\Paginator;

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
    public function __construct(EntityManager $em, EntityRepository $repository,
        Paginator $paginator)
    {
        $this->em         = $em;
        $this->repository = $repository;
        $this->paginator  = $paginator;
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
     * @param  int    $page = 1
     * @return array
     */
    public function getFilteredProductPaginator($brands, $categories, $page = 1)
    {
        $brands     = $brands     == '+' ? array() : explode(' ', $brands);
        $categories = $categories == '+' ? array() : explode(' ', $categories);
        
        return $this->paginator->paginate(
            $this->repository->getQueryForFindByBrandsAndCategories($brands, $categories),
            $page,
            $limit = 12
        );
    }
}
