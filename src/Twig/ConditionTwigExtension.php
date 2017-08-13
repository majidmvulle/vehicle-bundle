<?php

namespace MajidMvulle\Bundle\VehicleBundle\Twig;

use JMS\DiExtraBundle\Annotation as DI;
use MajidMvulle\Bundle\VehicleBundle\Form\ConditionType;

/**
 * Class ConditionTwigExtension.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 *
 * @DI\Service("majidmvulle.vehicle.twig.condition_extension", public=false)
 * @DI\Tag(name="twig.extension")
 */
class ConditionTwigExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [new \Twig_SimpleFunction('getBodyConditions', [$this, 'getBodyConditions'])];
    }

    /**
     * @return array
     */
    public function getBodyConditions()
    {
        return ConditionType::getConditions();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'getBodyConditions';
    }
}
