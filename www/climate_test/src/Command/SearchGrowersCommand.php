<?php

namespace App\Command;

use App\Entity\Grower;
use App\Repository\GrowerRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SearchGrowersCommand extends Command
{
    // the name of the command (the part after "bin/console")
    protected static $defaultName = 'app:search-growers';
    private $container;

    public function __construct(ContainerInterface $container)
    {
        parent::__construct();
        $this->container = $container;
    }

    protected function configure()
    {
        $this
            // the short description shown while running "php bin/console list"
            ->setDescription('List the names of every grower that has planted a specific crop type this year')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('List the names of every grower that has planted a specific crop type this year')

            ->addArgument('crop_type', InputArgument::REQUIRED, 'The name of the crop type')
            ->addArgument('year', InputArgument::OPTIONAL, 'The year of the planting event');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $cropType = $input->getArgument('crop_type');
        $year = $input->getArgument('year') ?
            $input->getArgument('year') : date('Y');

        $output->writeln([
            '',
            'Searching growers...',
            '=========================',
            'Crop type: ' . $cropType,
            'year: ' . $year,
        ]);



        $em = $this->container->get('doctrine')->getManager();
        $repo = $em->getRepository(Grower::class);
        $growers = $repo->findByYearAndCropType($year, $cropType);

        if ($growers) {
            foreach ($growers as $grower) {
                $output->writeln('Grower: ' . $grower->getName());
            }
        } else {
            $output->writeln('No growers found!');
        }
    }
}