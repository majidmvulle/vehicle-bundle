<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Repository;

use MajidMvulle\Bundle\UtilityBundle\ORM\EntityRepository;
use MajidMvulle\Bundle\VehicleBundle\Entity\Model;

/**
 * Class ModelTypeRepository.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class ModelTypeRepository extends EntityRepository
{
    public function findAllBy($makeId = null, $modelId = null, $offset = 0, $limit = 300): array
    {
        $queryBuilder = $this->createQueryBuilder('modelType')
            ->innerJoin('modelType.model', 'model')
            ->innerJoin('model.make', 'make');

        if ($modelId) {
            $queryBuilder->where('model.id = :modelId')->setParameter('modelId', $modelId)->addGroupBy('model.id');
        } elseif ($makeId) {
            $queryBuilder->where('make.id = :makeId')->setParameter('makeId', $makeId)->addGroupBy('make.id');
        }

        return $queryBuilder->addOrderBy('model.name')
            ->addGroupBy('modelType.id')
            ->addOrderBy('modelType.engine')
            ->addGroupBy('modelType.engine')
            ->addGroupBy('modelType.bodyType')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }

    public function findByModelYear(Model $model, $year): array
    {
        $year = (int) $year;

        return $this->createQueryBuilder('modelType')
            ->innerJoin('modelType.model', 'model', 'WITH', 'model = :model')
            ->innerJoin('model.make', 'make', 'WITH', 'model.make = make')
            ->where('make.active = :active')
            ->andWhere('model.active = :active')
            ->andWhere('modelType.years LIKE :year')
            ->setParameter(':model', $model)
            ->setParameter('active', true)
            ->setParameter(':year', '%'.$year.'%')
            ->orderBy('modelType.trim', 'ASC')
            ->getQuery()
            ->getResult();
    }

    public function findByYear($year, $offset, $limit): array
    {
        return $this->createQueryBuilder('modelType')
            ->where('modelType.years LIKE :year')
            ->setParameter(':year', '%'.$year.'%')
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->getQuery()
            ->getResult();
    }
}
