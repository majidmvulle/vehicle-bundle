<?php

namespace MajidMvulle\VehicleBundle\Twig;

use JMS\DiExtraBundle\Annotation as DI;
use MajidMvulle\VehicleBundle\Form\MileageType;

/**
 * Class MileageTwigExtension.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 *
 * @DI\Service("majidmvulle.vehicle.twig.mileage_extension", public=false)
 * @DI\Tag(name="twig.extension")
 */
class MileageTwigExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [new \Twig_SimpleFunction('getMileages', [$this, 'getMileages'])];
    }

    /**
     * @return array
     */
    public function getMileages()
    {
        return MileageType::getMileages();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'getMileages';
    }
}
