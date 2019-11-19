<?php

namespace Ktpl\Managecomplaints\Controller\Adminhtml\Action;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\View\LayoutFactory;

class Index extends Action
{
    /** @var PageFactory */
    protected $_resultPageFactory;
    /** @var RawFactory */
    protected $_resultRawFactory;
    /** @var LayoutFactory */
    protected $_layoutFactory;

    /**
     * Index constructor.
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     * @param RawFactory $resultRawFactory
     * @param LayoutFactory $layoutFactory
     */
    public function __construct(Action\Context $context, PageFactory $resultPageFactory, Rawfactory $resultRawFactory, LayoutFactory $layoutFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultRawFactory = $resultRawFactory;
        $this->_layoutFactory = $layoutFactory;
        parent::__construct($context);
    }

    /**
     * Show content in page of in raw format according to request
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        if ($this->getRequest()->getParam('isAjax')) {
            $resultPage = $this->_resultRawFactory->create();
            $layout = $this->_layoutFactory->create();
            $pagesGrid = $layout->createBlock('Ktpl\Managecomplaints\Block\Grid\Index', 'grid.view.grid');
            $resultPage->setContents($pagesGrid->toHtml());
        } else {
            $resultPage = $this->_resultPageFactory->create();
            $resultPage->getConfig()->getTitle()->prepend((__('Managecomplaints')));
        }
        return $resultPage;
    }

    /**
     * check acl condition
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Ktpl_Managecomplaints::managecomplaints_list');
    }
}
