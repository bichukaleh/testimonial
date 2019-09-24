<?php
/**
 * Created by PhpStorm.
 * User: heena
 * Date: 17/9/19
 * Time: 5:41 PM
 */
namespace KTPL\Testimonial\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;
class Printname extends Command
{

    const NAME = 'name';

    protected function configure()
    {
        $options = [
            new InputOption(
                self::NAME,
                null,
                InputOption::VALUE_REQUIRED,
                'Name'
            )
        ];

        $this->setName('print:name')
            ->setDescription('Print given name')
            ->setDefinition($options);

        parent::configure();
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($name = $input->getOption(self::NAME)) {
            $output->writeln("Hello " . $name);
        } else {
            $output->writeln("Hello World");
        }

        return $this;

    }
}