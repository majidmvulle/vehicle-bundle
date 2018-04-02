<?php

namespace MajidMvulle\Bundle\VehicleBundle\Twig;

use MajidMvulle\Bundle\VehicleBundle\Form\MileageType;

/**
 * Class MileageTwigExtension.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class MileageTwigExtension extends \Twig_Extension
{
    public function getFunctions(): array
    {
        return [new \Twig_SimpleFunction('getMileages', [$this, 'getMileages'])];
    }

    public function getMileages(): array
    {
        return MileageType::getMileages();
    }

    public function getName(): string
    {
        return 'getMileages';
    }
}
