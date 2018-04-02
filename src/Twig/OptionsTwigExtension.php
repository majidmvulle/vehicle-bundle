<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Twig;

use MajidMvulle\Bundle\VehicleBundle\Form\OptionsType;

/**
 * Class OptionsTwigExtension.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class OptionsTwigExtension extends \Twig_Extension
{
    public function getFunctions(): array
    {
        return [new \Twig_SimpleFunction('getVehicleOptions', [$this, 'getVehicleOptions'])];
    }

    public function getVehicleOptions(): array
    {
        return OptionsType::getOptions();
    }

    public function getName(): string
    {
        return 'getVehicleOptions';
    }
}
