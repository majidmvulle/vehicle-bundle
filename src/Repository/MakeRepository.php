<?php

namespace MajidMvulle\Bundle\VehicleBundle\Repository;

use MajidMvulle\Bundle\UtilityBundle\ORM\EntityRepository;
use MajidMvulle\Bundle\UtilityBundle\Request\Options\ListOptions;
use MajidMvulle\Bundle\VehicleBundle\Entity\Make;

/**
 * Class MakeRepository.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class MakeRepository extends EntityRepository
{
    /**
     * Override findAll() to always sort by `name`.
     *
     * @return array
     */
    public function findAll()
    {
        return $this->findBy(['active' => true], ['name' => 'ASC']);
    }

    /**
     * @return array
     */
    public function findAllAsChoices()
    {
        $data = [];
        $makes = $this->findAll();
        /** @var Make $make */
        foreach ($makes as $make) {
            $data[$make->getId()] = $make->getName();
        }

        return $data;
    }

    /**
     * Finds all Makes paginated.
     *
     * @param ListOptions $options
     *
     * @return array
     */
    public function findAllPaginated(ListOptions $options)
    {
        $qb = $this->_em->createQueryBuilder('make')
            ->select('make')
            ->from(Make::class, 'make')
            ->where('make.active = :active')
            ->orderBy('make.name', 'ASC')
            ->setFirstResult($options->getOffset())
            ->setMaxResults($options->getLimit())
            ->setParameter(':active', true);

        return $this->getResults($qb);
    }
}
