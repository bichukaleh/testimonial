<?php

namespace KTPL\Testimonial\Controller\Adminhtml\Testimonial;

use KTPL\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;

class Edit extends \Magento\Backend\App\Action
{
    protected $resultPageFactory = false;
    protected $collection;

    /**
     * Edit constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param CollectionFactory $collectionFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory, CollectionFactory $collectionFactory
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
        $this->collection=$collectionFactory;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $testimonialId = $this->getRequest()->getParam('testimonial_id');
        $resultPage = $this->resultPageFactory->create();
        if($testimonialId){
            $resultPage->getConfig()->getTitle()->prepend((__('Edit Testimonial')));
        }else{
            $resultPage->getConfig()->getTitle()->prepend((__('Add Testimonial')));
        }

        return $resultPage;
    }
}