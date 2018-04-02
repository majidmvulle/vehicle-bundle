<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Repository;

use MajidMvulle\Bundle\UtilityBundle\ORM\EntityRepository;
use MajidMvulle\Bundle\VehicleBundle\Entity\Make;
use MajidMvulle\Bundle\VehicleBundle\Entity\Model;

/**
 * Class ModelRepository.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class ModelRepository extends EntityRepository
{
    public function findByMakeSource($source): array
    {
        return $this->createQueryBuilder('model')
            ->innerJoin('model.make', 'make')
            ->where('make.source = :source')
            ->setParameter('source', $source)
            ->getQuery()
            ->getResult();
    }

    public function findByMakeId($makeId, $offset = 0, $limit = 200): array
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

    public function findByMakeYear(Make $make, $year): array
    {
        return $this->createQueryBuilder('model')
            ->innerJoin('model.make', 'make', 'WITH', 'make = :make')
            ->innerJoin(
                'model.modelTypes',
                'modelType',
                'WITH',
                'modelType.model = model'
            )
            ->where('make.active = :active')
            ->andWhere('model.active = :active')
            ->andWhere('modelType.years LIKE :year')
            ->setParameter(':make', $make)
            ->setParameter('active', true)
            ->setParameter(':year', '%'.$year.'%')
            ->orderBy('model.name', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByModelYear($id, $year): ?Model
    {
        return $this->createQueryBuilder('model')
            ->innerJoin('model.make', 'make', 'WITH', 'make = model.make')
            ->innerJoin(
                'model.modelTypes',
                'modelType',
                'WITH',
                'modelType.model = model'
            )
            ->where('model.id = :modelId')
            ->andWhere('make.active = :active')
            ->andWhere('model.active = :active')
            ->andWhere('modelType.years LIKE :year')
            ->setParameter(':modelId', $id)
            ->setParameter('active', true)
            ->setParameter(':year', '%'.$year.'%')
            ->getQuery()
            ->getOneOrNullResult();
    }
}
