<?php

namespace MajidMvulle\VehicleBundle\Twig;

use JMS\DiExtraBundle\Annotation as DI;
use MajidMvulle\VehicleBundle\Form\ModelYearType;

/**
 * Class ModelYearTwigExtension.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 *
 * @DI\Service("majidmvulle.vehicle.twig.year_extension", public=false)
 * @DI\Tag(name="twig.extension")
 */
class ModelYearTwigExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [new \Twig_SimpleFunction('getModelYears', [$this, 'getModelYears'])];
    }

    /**
     * @return array
     */
    public function getModelYears()
    {
        return ModelYearType::getYears();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'getModelYears';
    }
}
