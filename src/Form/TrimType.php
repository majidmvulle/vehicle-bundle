<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class TrimType.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class TrimType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => 'Vehicle Regional Specifications',
            'choices' => array_flip(self::getTrims()),
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

    public static function getTrims(): array
    {
        return ['base' => 'Base option', 'mid' => 'Mid option', 'full' => 'Full option', 'other' => 'Other'];
    }
}
