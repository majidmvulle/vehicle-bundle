<?php

namespace MajidMvulle\Bundle\VehicleBundle\Twig;

use MajidMvulle\Bundle\VehicleBundle\Form\ModelYearType;

/**
 * Class ModelYearTwigExtension.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class ModelYearTwigExtension extends \Twig_Extension
{
    public function getFunctions(): array
    {
        return [new \Twig_SimpleFunction('getModelYears', [$this, 'getModelYears'])];
    }

    public function getModelYears(): array
    {
        return ModelYearType::getYears();
    }

    public function getName(): string
    {
        return 'getModelYears';
    }
}
