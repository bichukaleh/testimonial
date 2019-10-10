<?php
namespace KTPL\Training\Controller\Index;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
class Test extends Action
{
    protected $request;
    protected $_pageFactory;
    protected $url;

    /**
     * Test constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param UrlInterface $url
     */
    public function __construct(Context $context, PageFactory $pageFactory, UrlInterface $url)
    {
        $this->_pageFactory = $pageFactory;
        $this->resultRedirectFactory = $context->getResultRedirectFactory();
        $this->resultFactory = $context->getResultFactory();
        $this->url = $url;
        parent::__construct($context);
    }

    public function execute()
    {
        $pageFactory= $this->_pageFactory->create();
        $pageFactory->getConfig()->getTitle()->set("Test");
        return $pageFactory;
    }
}