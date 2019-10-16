<?php

namespace KTPL\Testimonial\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class NewTestimonial extends Action
{
    protected $_pageFactory;

    /**
     * NewTestimonial constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    public function execute()
    {
        $pageFactory = $this->_pageFactory->create();
        $pageFactory->getConfig()->getTitle()->set('Add New Testimonial');
        return $pageFactory;
    }


}