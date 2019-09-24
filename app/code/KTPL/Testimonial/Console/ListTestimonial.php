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
use KTPL\Testimonial\Model\TestimonialFactory;

class ListTestimonial extends Command
{
    protected $collectionFactory;

    public function __construct(TestimonialFactory $collectionFactory)
    {
        $this->collection = $collectionFactory;
        parent::__construct();
    }

    protected function configure()
    {
        $this->setName('testimonial:list');
        $this->setDescription('List all testimonials');

        parent::configure();
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        foreach($this->collection->create()->getCollection()->getData() as $data){
            if($data['name'] != "") {
                $output->writeln($data['name']);
            }
        }

    }
}