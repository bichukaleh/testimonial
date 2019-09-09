<?php

namespace KTPL\Testimonial\Controller\Adminhtml\Testimonial;

use Magento\Framework\View\Result\PageFactory;
class Index extends \Magento\Backend\App\Action
{
	protected $resultPageFactory = false;
	protected $testimonial;

    /**
     * Index constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param PageFactory $resultPageFactory
     */
	public function __construct(
		\Magento\Backend\App\Action\Context $context,
		PageFactory $resultPageFactory
	)
	{
		parent::__construct($context);
		$this->resultPageFactory = $resultPageFactory;
	}

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
	public function execute()
	{
		$resultPage = $this->resultPageFactory->create();
		$resultPage->getConfig()->getTitle()->prepend((__('Testimonial')));

		return $resultPage;
	}


}