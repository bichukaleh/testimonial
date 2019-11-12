<?php

namespace KTPL\Customization\Controller\Adminhtml\Custom;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\View\LayoutFactory;
class Index extends Action
{
    /** @var PageFactory */
    protected $resultPageFactory;

    /**
     * ListTestimonials constructor.
     * @param Action\Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(Action\Context $context, PageFactory $resultPageFactory, Rawfactory $resultRawFactory, LayoutFactory $layoutFactory)
    {
        $this->resultPageFactory = $resultPageFactory;
        $this->resultRawFactory = $resultRawFactory;
        $this->layoutFactory = $layoutFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if ($this->getRequest()->getParam('isAjax')) {
            $resultPage =$this->resultRawFactory->create();
            $layout = $this->layoutFactory->create();
            $pagesGrid = $layout->createBlock('KTPL\Customization\Block\Grid\Grid', 'grid.view.grid');
            $resultPage->setContents($pagesGrid->toHtml());
        }else{
            $resultPage = $this->resultPageFactory->create();
            $resultPage->getConfig()->getTitle('Customization');
        }
        return $resultPage;
    }
}