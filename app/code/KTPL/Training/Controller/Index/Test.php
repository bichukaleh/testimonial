<?php
namespace KTPL\Training\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Test extends Action
{
    protected $_pageFactory;

    /**
     * Test constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(Context $context, PageFactory $pageFactory)
    {
        $this->_pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $pageFactory= $this->_pageFactory->create();
        $pageFactory->getConfig()->getTitle()->set("Test");
        return $pageFactory;
    }
}