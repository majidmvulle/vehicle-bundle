<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Admin;

use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * Class ModelAdmin.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class ModelAdmin extends AbstractAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('name', TextType::class)
            ->add('make')
            ->add('sourceId')
            ->add('active', CheckboxType::class, ['required' => false]);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id')
            ->add('name')
            ->add('make')
            ->add('active', 'checkbox', ['editable' => true])
            ->add('sourceId')->add('createdAt')
            ->add('updatedAt')
            ->add('_action', 'actions', ['actions' => ['show' => [], 'edit' => [], 'delete' => []]]);
    }

    /**
     * {@inheritdoc}
     */
    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter->add('name')->add('make')->add('active');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('id')
            ->add('name')
            ->add('make')
            ->add('active', 'checkbox')
            ->add('sourceId')
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
