<?php

namespace MajidMvulle\Bundle\VehicleBundle\Command;

use MajidMvulle\Bundle\VehicleBundle\Entity\ModelType;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class Yearify.
 *
 * @author Majid Mvulle <majid@majidmvulle.com>
 */
class Yearify extends ContainerAwareCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this->setName('majidmvulle:vehicle:yearify')
            ->addArgument('startYear', InputArgument::REQUIRED, 'Start Year')
            ->addArgument('endYear', InputArgument::REQUIRED, 'End Year')
            ->addOption('batch-size', null, InputOption::VALUE_OPTIONAL, 'Query batch size', 1000)
            ->setDescription('Adds missing years for ModelTypes from startYear to endYear');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $startYear = (int) $input->getArgument('startYear');
        $endYear = (int) $input->getArgument('endYear');

        if ($startYear < $endYear) {
            throw new \RuntimeException('End year should be greater than Start year');
        }

        $batchSize = (int) $input->getOption('batch-size');
        $entityManager = $this->getContainer()->get('doctrine.orm.entity_manager.abstract');
        $offset = 0;
        $years = range($startYear, $endYear);
        $output->writeln('Started Yearizing');

        do {
            $modelTypes = $entityManager->getRepository(ModelType::class)->findByYear($startYear, $offset, $batchSize);

            foreach ($modelTypes as $modelType) {
                $_years = array_merge($years, $modelType->getYears());
                asort($_years);
                $modelType->setYears($_years);
            }

            $entityManager->flush();
            $offset += $batchSize;
        } while ($modelTypes);

        $output->writeln('Done Yearizing');
    }
}
