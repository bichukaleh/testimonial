<?php
/**
 * Created by PhpStorm.
 * User: heena
 * Date: 17/9/19
 * Time: 6:29 PM
 */
namespace KTPL\Testimonial\Cron;

class Testimonials
{

    public function execute()
    {

        $writer = new \Zend\Log\Writer\Stream(BP . '/var/log/cron.log');
        $logger = new \Zend\Log\Logger();
        $logger->addWriter($writer);
        $logger->info("testimonials");

        return $this;

    }
}
