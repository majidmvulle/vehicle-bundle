<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TransmissionType.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class TransmissionType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => 'Vehicle Transmission',
            'choices' => array_flip(self::getTransmissions()),
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

    public static function getTransmissions(): array
    {
        return ['automatic' => 'Automatic', 'manual' => 'Manual', 'other' => 'Other'];
    }
}
