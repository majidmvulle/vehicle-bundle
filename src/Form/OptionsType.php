<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class OptionsType.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class OptionsType extends AbstractType
{
    const BASIC_OPTION = 'basic';
    const MID_OPTION = 'mid';
    const FULL_OPTION = 'full';

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => 'Vehicle Options',
            'choices' => array_flip(self::getOptions()),
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

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return $this->getBlockPrefix();
    }

    public static function getOptions(): array
    {
        return [
            self::BASIC_OPTION => 'Basic Option',
            self::MID_OPTION => 'Mid Option',
            self::FULL_OPTION => 'Full Option',
        ];
    }
}
