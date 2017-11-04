<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Class DictionaryCreateCommand
 * @package AppBundle\Command
 */
class DictionaryCreateCommand extends ContainerAwareCommand
{

    /**
     *
     */
    protected function configure()
    {
        $this
        ->setName('words:dictionary:create')
        ->setDescription('Dictonary create')
            ->setHelp('This command inserts words from file to database')
        ->addArgument(
            'offset',
            InputArgument::REQUIRED,
            'offset'
        )
        ->addArgument(
            'limit',
            InputArgument::REQUIRED,
            'limit'
        )
        ->addArgument(
            'file',
            InputArgument::OPTIONAL,
            'file with words',
            'slowa.txt'
        );
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->getContainer()
        ->get('dictionary')
        ->create($input->getArgument('file'), $input->getArgument('limit'), $input->getArgument('offset'));
    }
}
