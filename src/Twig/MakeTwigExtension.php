<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Twig;

use MajidMvulle\Bundle\UtilityBundle\ORM\EntityRepository;

/**
 * Class MakeTwigExtension.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class MakeTwigExtension extends \Twig_Extension
{
    /**
     * @var EntityRepository
     */
    private $repository;

    public function __construct(EntityRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getFunctions(): array
    {
        return [new \Twig_SimpleFunction('getMakes', [$this, 'getMakes'])];
    }

    public function getMakes(): array
    {
        return $this->repository->findAll();
    }

    public function getName(): string
    {
        return 'getMakes';
    }
}
