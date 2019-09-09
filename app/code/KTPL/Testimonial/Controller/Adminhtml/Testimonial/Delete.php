<?php

namespace KTPL\Testimonial\Controller\Adminhtml\Testimonial;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use KTPL\Testimonial\Model\TestimonialFactory;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\MediaStorage\Model\File\UploaderFactory;

class Delete extends Action
{

    protected $_pageFactory;
    protected $_testimonialFactory;
    protected $_timezoneInterface;

    /**
     * Save constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param TestimonialFactory $testimonialFactory
     * @param TimezoneInterface $timezone
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(Context $context, PageFactory $pageFactory, TestimonialFactory $testimonialFactory, TimezoneInterface $timezone)
    {
        $this->_pageFactory = $pageFactory;
        $this->_testimonialFactory = $testimonialFactory;
        $this->_timezoneInterface = $timezone;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
            try {
                $testimonial = $this->_testimonialFactory->create();
                $input['deleted_at'] = $this->_timezoneInterface->date()->format('m/d/y H:i:s');

                if ($id = $this->getRequest()->getParam('testimonial_id')) {
                    $testimonial->setId($id)->addData($input)->save();
                }
                $this->messageManager->addSuccessMessage(__('Testimonial details deleted successfully..'));
                return $this->_redirect('ktpl_testimonial/testimonial/index');
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
                return $this->_redirect('ktpl_testimonial/testimonial/index');
            }
    }

}