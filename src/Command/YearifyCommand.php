<?php

declare(strict_types=1);

namespace MajidMvulle\Bundle\VehicleBundle\Command;

use Doctrine\ORM\EntityManagerInterface;
use MajidMvulle\Bundle\VehicleBundle\Entity\ModelType;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class YearifyCommand.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class YearifyCommand extends ContainerAwareCommand
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, $name = null)
    {
        parent::__construct($name);
        $this->entityManager = $entityManager;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure(): void
    {
        $this->setName('majidmvulle:vehicle:yearify')
            ->addArgument('startYear', InputArgument::REQUIRED, 'Start Year')
            ->addArgument('endYear', InputArgument::REQUIRED, 'End Year')
            ->addOption('batch-size',
                null,
                InputOption::VALUE_OPTIONAL,
                'Query batch size',
                1000)
            ->setDescription('Adds missing years for ModelTypes from startYear to endYear');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $startYear = (int) $input->getArgument('startYear');
        $endYear = (int) $input->getArgument('endYear');

        if ($startYear > $endYear) {
            throw new \RuntimeException('End year should be greater than Start year');
        }

        $batchSize = (int) $input->getOption('batch-size');
        $offset = 0;
        $years = range($startYear, $endYear);

        $output->writeln('Started Yearizing');

        do {
            $modelTypes = $this->entityManager->getRepository(ModelType::class)->findByYear($startYear, $offset, $batchSize);
            foreach ($modelTypes as $modelType) {
                $_years = array_merge($years, $modelType->getYears());
                arsort($_years);
                $modelType->setYears(array_values(array_unique($_years)));
            }
            $this->entityManager->flush();
            $offset += $batchSize;
        } while ($modelTypes);

        $output->writeln('Done Yearizing');
    }
}
