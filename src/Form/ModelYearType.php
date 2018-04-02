<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ModelYearType.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class ModelYearType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'label' => 'Vehicle Model Year',
            'choices' => self::getYears(),
            'placeholder' => '',
            'choices_as_values' => true,
            'choice_label' => function ($value, $key, $index) {
                if ($value) {
                    return $value;
                }
            },
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix(): string
    {
        return '';
    }

    public function getName(): string
    {
        return $this->getBlockPrefix();
    }

    public static function getYears(): array
    {
        return range(date('Y') + 1, date('Y') - 90);
    }
}
