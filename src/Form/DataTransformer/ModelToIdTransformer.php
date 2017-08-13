<?php

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

    /**
     * Constructor.
     *
     * @param ObjectManager $manager
     */
    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an object (Model) to a string (id).
     *
     * @param Model|null $model
     *
     * @return string
     */
    public function transform($model)
    {
        if (null === $model) {
            return '';
        }

        return $model->getId();
    }

    /**
     * Transforms a string (id) to an object (Model).
     *
     * @param string $modelId
     *
     * @throws TransformationFailedException if object (Model) is not found
     *
     * @return Model|null
     */
    public function reverseTransform($modelId)
    {
        if (!$modelId) {
            return;
        }

        $model = $this->manager->getRepository(Model::class)->find($modelId);

        if ($model === null) {
            throw new TransformationFailedException(sprintf('Vehicle Model with id "%s" does not exist!', $modelId));
        }

        return $model;
    }
}
