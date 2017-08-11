<?php

namespace MajidMvulle\VehicleBundle\Form\DataTransformer;

use Doctrine\Common\Persistence\ObjectManager;
use MajidMvulle\VehicleBundle\Entity\Make;
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
     * Transforms an object (Make) to a string (id).
     *
     * @param Make|null $make
     *
     * @return string
     */
    public function transform($make)
    {
        if (null === $make) {
            return '';
        }

        return $make->getId();
    }

    /**
     * Transforms a string (id) to an object (Make).
     *
     * @param string $makeId
     *
     * @throws TransformationFailedException if object (Make) is not found
     *
     * @return Make|null
     */
    public function reverseTransform($makeId)
    {
        if (!$makeId) {
            return;
        }

        $make = $this->manager->getRepository(Make::class)->find($makeId);

        if ($make === null) {
            throw new TransformationFailedException(sprintf('Vehicle Make with id "%s" does not exist!', $makeId));
        }

        return $make;
    }
}
