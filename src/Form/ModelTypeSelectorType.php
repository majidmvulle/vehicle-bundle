<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Form;

use Doctrine\Common\Persistence\ObjectManager;
use MajidMvulle\Bundle\VehicleBundle\Form\DataTransformer\ModelTypeToIdTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class ModelTypeSelectorType.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class ModelTypeSelectorType extends AbstractType
{
    /**
     * @var ObjectManager
     */
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer(new ModelTypeToIdTransformer($this->manager));
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'invalid_message' => 'The selected Vehicle Model Type does not exist',
            'label' => 'Vehicle Trim',
        ]);
    }

    public function getParent(): string
    {
        return TextType::class;
    }

    public function getName(): string
    {
        return '';
    }
}
