<?php

namespace KTPL\Testimonial\Controller\Index;

use Magento\Framework\Filesystem;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Action\Context;
use KTPL\Testimonial\Model\TestimonialFactory;
use Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\MediaStorage\Model\File\UploaderFactory;
class Testimonial extends Action
{
    protected $request;
    protected $_pageFactory;
    protected $_testimonialFactory;
    protected $_timezoneInterface;
    protected $_file;
    protected $scopeConfig;
    protected $_uploadFactory;
    protected $_mediaDirectory;
    protected $_fileSystem;

    /**
     * Testimonial constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param Filesystem $filesystem
     * @param TestimonialFactory $testimonialFactory
     * @param TimezoneInterface $timezone
     * @param File $file
     * @param ScopeConfigInterface $scopeConfig
     * @param UploaderFactory $uploaderFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        Filesystem $filesystem,
        TestimonialFactory $testimonialFactory,
        TimezoneInterface $timezone, File $file,
        ScopeConfigInterface $scopeConfig,
        UploaderFactory $uploaderFactory)
    {
        $this->_pageFactory = $pageFactory;
        $this->_testimonialFactory = $testimonialFactory;
        $this->_timezoneInterface = $timezone;
        $this->_file = $file;
        $this->scopeConfig = $scopeConfig;
        $this->__uploadFactory = $uploaderFactory;
        $this->_fileSystem = $filesystem;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
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
            $file = $this->getRequest()->getFiles();
            $input['image'] = $file['image'];
            $_FILES['image']=$file['image'];

            try {
                $testimonial = $this->_testimonialFactory->create();
                $collection = $testimonial->getCollection();

                $input['updated_at'] = $this->_timezoneInterface->date()->format('m/d/y H:i:s');
                $autoApproveStatus = $this->scopeConfig->getValue('testimonial/general/auto_approve', $this->scopeConfig::SCOPE_TYPE_DEFAULT);
                if ($autoApproveStatus) {
                    $input['is_approved'] = $autoApproveStatus;
                } else {
                    $input['is_approved'] = 0;
                }
                if (isset($input['image']) && $input['image']['name'] != "") {
                    $mediaDirectory = $this->_objectManager->get('Magento\Framework\Filesystem')->getDirectoryRead(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
                    $mediaRootDir = $mediaDirectory->getAbsolutePath('testimonial/tmp');

                    if ($this->_file->isExists($mediaRootDir . '/' . $input['image']['name'])) {
                        $this->_file->deleteFile($mediaRootDir . '/' . $input['image']['name']);
                    }
                    $target = $this->_mediaDirectory->getAbsolutePath('testimonial/');
                    $uploader = $this->__uploadFactory->create(['fileId' => 'image']);
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png', 'zip', 'doc']);
                    $uploader->setFilesDispersion(false);

                    $uploader->save($target);
                    $input['image'] = $input['image']['name'];
                }

                if ($id = $this->getRequest()->getParam('testimonial_id')) {
                    $testimonial->setId($id)->setData($input)->save();
                    $this->messageManager->addSuccessMessage(__('Testimonial details updated successfully..'));
                } else {
                    $input['created_at'] = $this->_timezoneInterface->date()->format('m/d/y H:i:s');
                    $input['sort_order'] = count($collection) + 1;
                    $testimonial->setData($input)->save();
                    $this->messageManager->addSuccessMessage(__('Testimonial details added successfully..'));
                }
            } catch (\Exception $exception) {
                $this->messageManager->addErrorMessage($exception->getMessage());
            }
        }
        return $this->_redirect('testimonial/index/newtestimonial');
    }

}