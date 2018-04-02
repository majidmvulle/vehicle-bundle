<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Twig;

use MajidMvulle\Bundle\VehicleBundle\Form\SpecificationType;

/**
 * Class SpecificationTwigExtension.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class SpecificationTwigExtension extends \Twig_Extension
{
    public function getFunctions(): array
    {
        return [new \Twig_SimpleFunction('getSpecifications', [$this, 'getSpecifications'])];
    }

    public function getSpecifications(): array
    {
        return SpecificationType::getSpecifications();
    }

    public function getName(): string
    {
        return 'getSpecifications';
    }
}
