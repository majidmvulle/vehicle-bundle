<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class MileageType.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class MileageType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => 'Vehicle Mileage',
            'choices' => array_flip(self::getMileages()),
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

    public static function getMileages(): array
    {
        $listOfMileages = array_merge([5000], range(10000, 250000, 10000));
        $mileages = [];
        array_map(function ($value) use (&$mileages) {
            return $mileages[$value] = sprintf('Up to %s', number_format($value));
        }, $listOfMileages);

        $mileages[260000] = 'Other';

        return $mileages;
    }
}
