<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class SpecificationType.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class SpecificationType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => 'Vehicle Regional Specifications',
            'choices' => array_flip(self::getSpecifications()),
            'placeholder' => '',
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    public function getBlockPrefix(): string
    {
        return '';
    }

    public function getName(): string
    {
        return $this->getBlockPrefix();
    }

    public static function getSpecifications(): array
    {
        return [
            'gcc' => 'GCC Specs',
            'usa' => 'US Specs',
            'jpn' => 'Japanese Specs',
            'euro' => 'European Specs',
            'other' => 'Other',
        ];
    }
}
