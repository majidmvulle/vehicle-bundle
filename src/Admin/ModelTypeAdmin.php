<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Admin;

use MajidMvulle\Bundle\VehicleBundle\Form\ModelYearType;
use MajidMvulle\Bundle\VehicleBundle\Form\TransmissionType;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ModelTypeAdmin.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class ModelTypeAdmin extends AbstractAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('trim', TextType::class, ['label' => 'Trim Name'])
            ->add('model')
            ->add('engine', IntegerType::class, [
                'help' => 'e.g. 2500 for a 2.5 litre engine',
                'required' => false,
            ])
            ->add('cylinders', IntegerType::class, ['required' => false])
            ->add('transmission', TransmissionType::class, ['required' => false])
            ->add('seats', IntegerType::class, ['required' => false])
            ->add('isGcc', CheckboxType::class, ['required' => false])
            ->add('years', ModelYearType::class, ['multiple' => true, 'required' => false])
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')
            ->add('trim')
            ->add('model')
            ->add('engine')
            ->add('cylinders')
            ->add('transmission')
            ->add('seats')
            ->add('isGcc')
            ->add('flattenedYears', null, ['label' => 'Years'])
            ->add('createdAt')
            ->add('updatedAt')
            ->add('_action', 'actions', [
                'actions' => ['show' => [], 'edit' => [], 'delete' => []], ]);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter->add('trim')->add('model')->add('isGcc');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')
            ->add('trim')
            ->add('model')
            ->add('engine')
            ->add('cylinders')
            ->add('transmission')
            ->add('seats')
            ->add('isGcc')
            ->add('flattenedYears', null, ['label' => 'Years'])
            ->add('createdAt')
            ->add('updatedAt');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureRoutes(RouteCollection $collection): void
    {
        $collection->clearExcept(['create', 'edit', 'show', 'list']);
    }
}
