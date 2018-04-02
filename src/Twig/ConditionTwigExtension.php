<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Twig;

use MajidMvulle\Bundle\VehicleBundle\Form\ConditionType;

/**
 * Class ConditionTwigExtension.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class ConditionTwigExtension extends \Twig_Extension
{
    public function getFunctions(): array
    {
        return [new \Twig_SimpleFunction('getBodyConditions', [$this, 'getBodyConditions'])];
    }

    public function getBodyConditions(): array
    {
        return ConditionType::getConditions();
    }

    public function getName(): string
    {
        return 'getBodyConditions';
    }
}
