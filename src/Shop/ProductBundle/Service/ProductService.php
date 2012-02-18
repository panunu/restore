<?php

namespace Shop\ProductBundle\Service;

use Doctrine\ORM\EntityManager,
    Shop\ProductBundle\Entity\Product,
    \DateTime,
    Doctrine\ORM\EntityRepository,
    Knp\Component\Pager\Paginator,
    Symfony\Component\Form\FormFactory,    
    Symfony\Component\Form\Form,
    Shop\ProductBundle\Form\Type\ProductFormType;

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
     * @var Paginator
     */
    protected $paginator;
    
    /**
     * @var FormFactory
     */
    protected $factory;
    
    /**
     *
     * @param EntityManager    $em
     * @param EntityRepository $repository
     * @param Paginator        $paginator
     * @param FormFactory      $formFactory 
     */
    public function __construct(EntityManager $em, EntityRepository $repository,
        Paginator $paginator, FormFactory $formFactory)
    {
        $this->em          = $em;
        $this->repository  = $repository;
        $this->paginator   = $paginator;
        $this->formFactory = $formFactory;
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
     * @param  string  $slug
     * @return Product
     */
    public function getProductBySlug($slug)
    {
        return $this->repository->findOneBySlug($slug);
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
    
    /**
     * @param  Product $product
     * @return ProductFormType
     */
    public function getProductForm(Product $product)
    {
        return $this->formFactory->create(
            new ProductFormType(get_class($product), $product)
        );
    }
}
