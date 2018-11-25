<?php

declare(strict_types=1);

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
    public function findAll(): array
    {
        return $this->findBy(['active' => true], ['name' => 'ASC']);
    }

    public function findAllAsChoices(): array
    {
        $data = [];
        $makes = $this->findAll();

        /** @var Make $make */
        foreach ($makes as $make) {
            $data[$make->getId()] = $make->getName();
        }

        return $data;
    }

    public function findAllPaginated(): array
    {
        $qb = $this->_em->createQueryBuilder('make')
            ->select('make')
            ->from(Make::class, 'make')
            ->where('make.active = :active')
            ->orderBy('make.name', 'ASC')
            ->setParameter(':active', true);

        return $this->getResults($qb);
    }
}
