<?php

namespace Shop\ProductBundle\Repository;

use Doctrine\ORM\EntityRepository as Repository,
    Doctrine\ORM\NoResultException;

class TaxRepository extends Repository
{
    public function findByTypeAndDate($type, $date)
    {
        $qb = $this->createBaseQueryBuilder()
            ->where('tax.type = :type')
            ->andWhere('tax.validity <= :date')
            ->orderBy('tax.validity', 'DESC')
            ->setMaxResults(1)
            ->setParameter('type', $type)
            ->setParameter('date', $date);
        
        try {
            return $qb->getQuery()->getSingleResult();
        } catch(NoResultException $e) {
            return null;
        }
    }
    
    protected function createBaseQueryBuilder()
    {
        return $this->getEntityManager()->createQueryBuilder()
            ->select('tax')
            ->from('Shop\ProductBundle\Entity\Tax', 'tax');
    }
}