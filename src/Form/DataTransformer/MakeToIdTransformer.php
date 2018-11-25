<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use MajidMvulle\Bundle\VehicleBundle\Entity\Make;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class MakeToIdTransformer.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class MakeToIdTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function transform($make): string
    {
        if (null === $make) {
            return '';
        }

        return $make->getId();
    }

    public function reverseTransform($makeId): ?Make
    {
        if (!$makeId) {
            return null;
        }

        $make = $this->manager->getRepository(Make::class)->find($makeId);

        if (null === $make) {
            throw new TransformationFailedException(
                sprintf('Vehicle Make with id "%s" does not exist!', $makeId)
            );
        }

        return $make;
    }
}
