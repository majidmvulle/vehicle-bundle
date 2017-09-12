<?php

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
    /**
     * Find one by id where modelTypes have year.
     *
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
     * Find by makeId.
     *
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

    /**
     * Find one by Make where modelTypes have year.
     *
     * @param Make $make
     * @param int  $year
     *
     * @return array
     */
    public function findByMakeYear(Make $make, $year)
    {
        return $this->createQueryBuilder('model')
            ->innerJoin('model.make', 'make', 'WITH', 'make = :make')
            ->innerJoin('model.modelTypes', 'modelType', 'WITH', 'modelType.model = model')
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
     * Find one by id where modelTypes have year.
     *
     * @param $id
     * @param $year
     *
     * @throws \Doctrine\ORM\NonUniqueResultException
     *
     * @return Model
     */
    public function findOneByModelYear($id, $year)
    {
        return $this->createQueryBuilder('model')
            ->innerJoin('model.make', 'make', 'WITH', 'make = model.make')
            ->innerJoin('model.modelTypes', 'modelType', 'WITH', 'modelType.model = model')
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
