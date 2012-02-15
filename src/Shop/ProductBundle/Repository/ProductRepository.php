<?php

namespace Shop\ProductBundle\Repository;

use Doctrine\ORM\EntityRepository as Repository,
    Doctrine\ORM\NoResultException,
    Doctrine\ORM\Query\Expr;

class ProductRepository extends Repository
{
    /**
     * @param  array $brands
     * @param  array $categories 
     * @return array
     */
    public function findByBrandsAndCategories(array $brands, array $categories)
    {
        return $this->getQueryForFindByBrandsAndCategories($brands, $categories)
            ->getResult();
    }
    
    /**
     * @param  array $brands
     * @param  array $categories 
     * @return array
     */
    public function getQueryForFindByBrandsAndCategories(array $brands, array $categories)
    {
        $qb = $this->createBaseQueryBuilder();        
         
        if(count($brands)) {
            $qb->join('product.brand', 'brand', Expr\Join::WITH, 'brand.slug IN(:brands)')
               ->setParameter('brands', $brands);
        }
                
        if(count($categories)) {
            $qb->join('product.category', 'category', Expr\Join::WITH, 'category.slug IN(:categories)')
               ->setParameter('categories', $categories);
        }

        return $qb->getQuery();
    }
    
    /**
     * @return QueryBuilder
     */
    protected function createBaseQueryBuilder()
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('product')
            ->from('Shop\ProductBundle\Entity\Product', 'product');
    }
}