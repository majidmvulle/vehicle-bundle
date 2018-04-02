<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ColorType.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class ColorType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => 'Vehicle Body Color',
            'choices' => array_flip(self::getColors()),
            'placeholder' => '',
            'data_class' => null,
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

    public function getName()
    {
        return $this->getBlockPrefix();
    }

    public static function getColors(): array
    {
        return [
            'white' => 'White',
            'silver' => 'Silver',
            'black' => 'Black',
            'grey' => 'Grey',
            'blue' => 'Blue',
            'red' => 'Red',
            'brown' => 'Brown',
            'green' => 'Green',
            'other' => 'Other',
        ];
    }
}
