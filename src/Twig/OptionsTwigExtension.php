<?php

namespace MajidMvulle\Bundle\VehicleBundle\Twig;

use JMS\DiExtraBundle\Annotation as DI;
use MajidMvulle\Bundle\VehicleBundle\Form\OptionsType;

/**
 * Class OptionsTwigExtension.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 *
 * @DI\Service("majidmvulle.vehicle.twig.options_extension", public=false)
 * @DI\Tag(name="twig.extension")
 */
class OptionsTwigExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [new \Twig_SimpleFunction('getVehicleOptions', [$this, 'getVehicleOptions'])];
    }

    /**
     * @return array
     */
    public function getVehicleOptions()
    {
        return OptionsType::getOptions();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'getVehicleOptions';
    }
}
