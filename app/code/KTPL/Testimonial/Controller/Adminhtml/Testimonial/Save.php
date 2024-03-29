<?php

namespace KTPL\Testimonial\Controller\Adminhtml\Testimonial;

use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Filesystem;
use KTPL\Testimonial\Model\TestimonialFactory;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\Filesystem\Driver\File;

class Save extends Action implements HttpPostActionInterface
{

    protected $_pageFactory;
    protected $_testimonialFactory;
    protected $_timezoneInterface;
    protected $_file;

    /**
     * Save constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param TestimonialFactory $testimonialFactory
     * @param TimezoneInterface $timezone
     * @param File $file
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(Context $context, PageFactory $pageFactory, TestimonialFactory $testimonialFactory, TimezoneInterface $timezone, File $file)
    {
        $this->_pageFactory = $pageFactory;
        $this->_testimonialFactory = $testimonialFactory;
        $this->_timezoneInterface = $timezone;
        $this->_file = $file;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        if ($this->getRequest()->isPost()) {
            $input = $this->getRequest()->getPostValue();

            try {
                $testimonial = $this->_testimonialFactory->create();

                $input['updated_at'] = $this->_timezoneInterface->date()->format('m/d/y H:i:s');

                if (isset($input['image'][0]) && $input['image'][0]['name'] != "") {
                    $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                    $mediaRootDir = $mediaDirectory->getAbsolutePath('testimonial/tmp');

                    if ($this->_file->isExists($mediaRootDir . '/'.$input['image'][0]['name']))  {
                        $this->_file->deleteFile($mediaRootDir. '/'. $input['image'][0]['name']);
                    }
                    $input['image'] = $input['image'][0]['name'];
                }
                if ($id = $this->getRequest()->getParam('testimonial_id')) {
                    $testimonial->setId($id)->setData($input)->save();
                    $this->messageManager->addSuccessMessage(__('Testimonial details updated successfully..'));
                } else {
                    $input['created_at'] = $this->_timezoneInterface->date()->format('m/d/y H:i:s');
                    $testimonial->setData($input)->save();
                    $this->messageManager->addSuccessMessage(__('Testimonial details added successfully..'));
                }
                return $this->_redirect('ktpl_testimonial/testimonial/index');
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
                return $this->_redirect('ktpl_testimonial/testimonial/index');
            }
        }
    }

}