<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Twig;

use MajidMvulle\Bundle\VehicleBundle\Form\ColorType;

/**
 * Class ColorTwigExtension.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class ColorTwigExtension extends \Twig_Extension
{
    public function getFunctions(): array
    {
        return [new \Twig_SimpleFunction('getColors', [$this, 'getColors'])];
    }

    public function getColors(): array
    {
        return ColorType::getColors();
    }

    public function getName(): string
    {
        return 'getColors';
    }
}
