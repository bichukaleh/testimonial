<?php

namespace KTPL\Testimonial\Controller\Index;

class Test extends \Magento\Framework\App\Action\Action
{


    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
//        $textDisplay = new \Magento\Framework\DataObject(array('text' => 'KTPL'));
//        $this->_eventManager->dispatch('ktpl_testimonial_display_text', ['mp_text' => $textDisplay]);
//        echo $textDisplay->getText();
//        exit;

        echo $this->setTitle('Welcome');
        echo $this->getTitle();
    }

    /**
     * @param $title
     * @return mixed
     */
    public function setTitle($title)
    {
        return $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
}