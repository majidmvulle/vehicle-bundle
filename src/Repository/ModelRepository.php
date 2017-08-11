<?php

namespace MajidMvulle\VehicleBundle\Repository;

use MajidMvulle\UtilityBundle\ORM\EntityRepository;

/**
 * Class ModelRepository.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class ModelRepository extends EntityRepository
{
    /**
     * @param $source
     *
     * @return array
     */
    public function findByMakeSource($source)
    {
        return $this->createQueryBuilder('model')
            ->innerJoin('model.make', 'make')
            ->where('make.source = :source')
            ->setParameter('source', $source)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $makeId
     * @param int $offset
     * @param int $limit
     *
     * @return array
     */
    public function findByMakeId($makeId, $offset = 0, $limit = 200)
    {
        return $this->createQueryBuilder('model')
            ->innerJoin('model.make', 'make')
            ->where('make.id = :makeId')
            ->andWhere('model.active = :active')
            ->setParameter('makeId', $makeId)
            ->setParameter('active', true)
            ->orderBy('model.name')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
