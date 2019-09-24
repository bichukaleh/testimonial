<?php

namespace KTPL\Testimonial\Controller\Index;

class CustomNoRoute extends \Magento\Framework\App\Action\Action
{


    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        echo "Oops ! 404...";
    }

}