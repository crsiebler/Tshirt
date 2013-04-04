<?php
// src/Tshirt/SiteBundle/Repository/DesignRepository.php

namespace Tshirt\SiteBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * 
 */
class DesignRepository extends EntityRepository
{
    public function getNewestDesigns($limit = 6)
    {
        $qb = $this->createQueryBuilder('d')
                   ->addOrderBy('d.created', 'DESC');
        
        if(false == is_null($limit))
            $qb->setMaxResults($limit);
        
        return $qb->getQuery()->getResult();
    }
}
?>
