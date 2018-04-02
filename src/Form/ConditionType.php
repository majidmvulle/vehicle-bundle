<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ConditionType.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class ConditionType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => 'Vehicle Condition',
            'choices' => array_flip(self::getConditions()),
            'placeholder' => '', ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return '';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }

    public static function getConditions(): array
    {
        return ['fair' => 'Fair', 'good' => 'Good', 'excellent' => 'Excellent'];
    }
}
