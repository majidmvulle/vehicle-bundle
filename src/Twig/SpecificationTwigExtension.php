<?php

namespace MajidMvulle\Bundle\VehicleBundle\Twig;

use JMS\DiExtraBundle\Annotation as DI;
use MajidMvulle\Bundle\VehicleBundle\Form\SpecificationType;

/**
 * Class SpecificationTwigExtension.
 * 
 * @author Majid Mvulle <majid@majidmvulle.com>
 *
 * @DI\Service("majidmvulle.vehicle.twig.specification_extension", public=false)
 * @DI\Tag(name="twig.extension")
 */
class SpecificationTwigExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [new \Twig_SimpleFunction('getSpecifications', [$this, 'getSpecifications'])];
    }

    /**
     * @return array
     */
    public function getSpecifications()
    {
        return SpecificationType::getSpecifications();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'getSpecifications';
    }
}
