<?php

namespace KTPL\Testimonial\Controller\Adminhtml\Testimonial;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\ForwardFactory;
use Magento\Framework\Registry;

class NewAction extends Action
{
    protected $resultForwardFactory;

    /**
     * NewAction constructor.
     * @param Action\Context $context
     * @param Registry $codeRegistry
     * @param ForwardFactory $forwardFactory
     */
    public function __construct(Action\Context $context, Registry $codeRegistry, ForwardFactory $forwardFactory)
    {
        $this->resultForwardFactory = $forwardFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Forward|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultForward = $this->resultForwardFactory->create();
        return $resultForward->forward('edit');
    }
}