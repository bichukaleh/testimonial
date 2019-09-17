<?php

namespace KTPL\Testimonial\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use KTPL\Testimonial\Model\TestimonialFactory;
use KTPL\Testimonial\Helper\Data;
use Magento\Backend\Model\UrlInterface;

class ListTestimonial extends Action
{
    protected $request;
    protected $_pageFactory;
    protected $_testimonialFactory;
    protected $url;

    /**
     * ListTestimonial constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param TestimonialFactory $testimonialFactory
     */
    public function __construct(Context $context, PageFactory $pageFactory, TestimonialFactory $testimonialFactory, Data $data, UrlInterface $url)
    {
        $this->_pageFactory = $pageFactory;
        $this->_testimonialFactory = $testimonialFactory;
        $this->dataHelper = $data;
        $this->resultRedirectFactory = $context->getResultRedirectFactory();
        $this->resultFactory = $context->getResultFactory();
        $this->url = $url;
        parent::__construct($context);
    }

    public function execute()
    {
        return $this->_pageFactory->create();
    }

}