<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use MajidMvulle\Bundle\VehicleBundle\Entity\Model;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Class ModelToIdTransformer.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class ModelToIdTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function transform($model): int
    {
        if (null === $model) {
            return '';
        }

        return $model->getId();
    }

    public function reverseTransform($modelId): ?Model
    {
        if (!$modelId) {
            return null;
        }

        $model = $this->manager->getRepository(Model::class)->find($modelId);

        if (null === $model) {
            throw new TransformationFailedException(
                sprintf('Vehicle Model with id "%s" does not exist!', $modelId)
            );
        }

        return $model;
    }
}
