<?php

namespace KTPL\Testimonial\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use KTPL\Testimonial\Model\TestimonialFactory;
class Testimonial extends Action
{
    protected $request;
    protected $_pageFactory;
    protected $_testimonialFactory;

    /**
     * Testimonial constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param TestimonialFactory $testimonialFactory
     */
    public function __construct(Context $context, PageFactory $pageFactory, TestimonialFactory $testimonialFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->_testimonialFactory = $testimonialFactory;
        parent::__construct($context);
    }

    /**
     * save data
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Exception
     */
    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            $input = $this->getRequest()->getPostValue();
            $testimonial = $this->_testimonialFactory->create();
            $collection = $testimonial->getCollection();
            $input['created_at'] = date('Y-m-d');
            $input['updated_at'] = date('Y-m-d');
            $input['sort_order'] = count($collection) + 1;
            $testimonial->setData($input)->save();
            $this->messageManager->addSuccessMessage('Testimonial added successfully!!');
        }
        return $this->_redirect('testimonial/index/newtestimonial');
    }

}