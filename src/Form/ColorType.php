<?php

namespace MajidMvulle\VehicleBundle\Form;

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
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'label' => 'Vehicle Body Color',
            'choices' => self::getColors(),
            'placeholder' => '',
            'data_class' => null,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getParent()
    {
        return ChoiceType::class;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'majidmvulle_vehicle_color_type';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * Gets Colors.
     *
     * @return array
     */
    public static function getColors()
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
