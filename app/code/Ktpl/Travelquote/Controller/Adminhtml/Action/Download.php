<?php

namespace Ktpl\Travelquote\Controller\Adminhtml\Action;

use Ktpl\Travelquote\Model\TravelquoteFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\Result\RawFactory;
use Magento\Framework\Filesystem\DirectoryList;
use Magento\Setup\Exception;

class Download extends Action
{
    /**
     * @var RawFactory
     */
    protected $_resultRawFactory;
    /**
     * @var FileFactory
     */
    protected $_fileFactory;
    /**
     * @var DirectoryList
     */
    protected $_directory;
    /**  @var TravelquoteFactory */
    protected $_travelquoteFactory;

    /**
     * Download constructor.
     * @param RawFactory $resultRawFactory
     * @param TravelquoteFactory $travelquoteFactory
     * @param FileFactory $fileFactory
     * @param Context $context
     * @param DirectoryList $directoryList
     */
    public function __construct(RawFactory $resultRawFactory, TravelquoteFactory $travelquoteFactory, FileFactory $fileFactory, Context $context, DirectoryList $directoryList)
    {
        $this->_resultRawFactory = $resultRawFactory;
        $this->_travelquoteFactory = $travelquoteFactory;
        $this->_fileFactory = $fileFactory;
        $this->_directory = $directoryList;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function execute()
    {
        $postData = $this->getRequest()->getParams();
        $travelquote = $this->_travelquoteFactory->create();
        $travelquote->load($postData['id']);
        $key = $postData['document'] == '2' ? 'travel_document2' : 'travel_document';
        $fileName = $travelquote[$key];
        try {
            $file = $this->_directory->getPath("media") . "/travelquote/traveldocument" . $postData['document'] . "/" . $fileName;
            $content = @file_get_contents($file);
            if ($content == false) {
                $this->messageManager->addErrorMessage(__('Failed to download file.'));
                return $this->_redirect('ktpl_travelquote/action/index');
            }
            return $this->_fileFactory->create(
                $fileName,
                $content
            );
        } catch (Exception $exception) {
            return $this->_redirect('ktpl_travelquote/action/index');
        }
    }
}
