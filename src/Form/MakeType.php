<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Form;

use MajidMvulle\Bundle\UtilityBundle\ORM\EntityRepository;
use MajidMvulle\Bundle\VehicleBundle\Entity\Make;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MakeSelectorType.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class MakeType extends EntityType
{
    /**
     * @var ManagerRegistry
     */
    private $managerRegistry;

    public function __construct(ManagerRegistry $managerRegistry)
    {
        $this->managerRegistry = $managerRegistry;
        parent::__construct($managerRegistry);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'placeholder' => '',
            'query_builder' => function (EntityRepository $entityRepository) {
                $queryBuilder = $entityRepository->createQueryBuilder('m')
                    ->where('m.active = :active')
                    ->orderBy('m.name', 'ASC');
                $queryBuilder->setParameter('active', true);

                return $queryBuilder;
            },
            'class' => Make::class,
            'property' => 'name',
            'invalid_message' => 'The selected Vehicle Make does not exist',
        ]);
    }

    public function getParent(): string
    {
        return EntityType::class;
    }

    public function getName(): string
    {
        return $this->getBlockPrefix();
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
