<?php

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

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['label' => 'Vehicle Options', 'choices' => array_flip(self::getOptions()), 'placeholder' => '']);
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
        return 'majidmvulle_vehicle_options_type';
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return $this->getBlockPrefix();
    }

    /**
     * @return array
     */
    public static function getOptions()
    {
        return [self::BASIC_OPTION => 'Basic Option', self::MID_OPTION => 'Mid Option', self::FULL_OPTION => 'Full Option'];
    }
}
