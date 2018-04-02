<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use MajidMvulle\Bundle\VehicleBundle\Entity\ModelType;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class ModelTypeToIdTransformer.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class ModelTypeToIdTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function transform($modelType): string
    {
        if (null === $modelType) {
            return '';
        }

        return $modelType->getId();
    }

    public function reverseTransform($modelTypeId): ?ModelType
    {
        if (!$modelTypeId) {
            return;
        }

        $modelType = $this->manager->getRepository('MajidMvulleVehicleBundle:ModelType')->find($modelTypeId);

        if (null === $modelType) {
            throw new TransformationFailedException(
                sprintf('Vehicle Model Type with id "%s" does not exist!', $modelTypeId)
            );
        }

        return $modelType;
    }
}
