<?php

namespace Ktpl\Travelquote\Controller\Adminhtml\Action;

use Ktpl\Travelquote\Model\TravelquoteFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Filesystem\Driver\File;
use Magento\Backend\Helper\Data;

class Remove extends Action
{
    /**  @var TravelquoteFactory */
    protected $_travelquoteFactory;
    /** @var JsonFactory */
    protected $jsonFactory;
    /**
     * @var UploaderFactory
     */
    protected $_uploadFactory;
    /**
     * @var Filesystem\Directory\WriteInterface
     */
    protected $_mediaDirectory;
    /**
     * @var Filesystem
     */
    protected $_fileSystem;
    /**
     * @var File
     */
    protected $_file;
    /**
     * @var Data
     */
    protected $_backendData;

    /**
     * Remove constructor.
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param TravelquoteFactory $travelquoteFactory
     * @param UploaderFactory $uploaderFactory
     * @param Filesystem $filesystem
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(Context $context, JsonFactory $jsonFactory, TravelquoteFactory $travelquoteFactory, UploaderFactory $uploaderFactory, Filesystem $filesystem, File $file, Data $backendData)
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->_travelquoteFactory = $travelquoteFactory;
        $this->__uploadFactory = $uploaderFactory;
        $this->_fileSystem = $filesystem;
        $this->_file = $file;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->_backendData = $backendData;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $postData = $this->getRequest()->getParams();
        $travelquote = $this->_travelquoteFactory->create();
        $travelquoteDetails = $travelquote->load($postData['id']);

        if ($travelquoteDetails['travel_document'] != "" || $travelquoteDetails['travel_document2'] != "") {
            try {
                $target = $this->_mediaDirectory->getAbsolutePath('travelquote/traveldocument' . $postData['document']);
                if ($this->_file->isExists($target . '/' . $travelquoteDetails['travel_document' . $postData['document']])) {
                    $this->_file->deleteFile($target . '/' . $travelquoteDetails['travel_document' . $postData['document']]);
                }

                if ($id = $this->getRequest()->getParam('id')) {
                    $key = $postData['document'] == '2' ? 'travel_document2' : 'travel_document';
                    $input[$key] = '';
                    $input['id'] = $id;
                    $travelquote->setId($id)->setData($input)->save();
                }
                $url = $this->_backendData->getUrl('ktpl_travelquote/action/uploadfile');
                $divId = 'fileUploadForm' . $postData['document'] . 'Div' . $id;
                $formId = 'fileUploadForm' . $postData['document'] . $id;
                $inputName = $postData['document'] == '2' ? 'traveldocumentfile2' : 'traveldocumentfile';
                $submitbtnName = $postData['document'] == '2' ? 'travelDocument2btnSubmit' : 'travelDocument1btnSubmit';

                $html = '<div id="' . $divId . '" <form id="' . $formId . '" method="post" enctype="multipart/form-data" novalidate="novalidate">';
                $html .= "<input type='file' name='$inputName' id='$id'/>";
                $html .= "<button data-id='$id' data-url='$url' id='$submitbtnName' class='custom-upload-btn'>Upload Document</button>";
                $html .= "</form></div>";
                return $resultJson->setData([
                    'messages' => 'Document removed successfully.',
                    'content' => $html,
                    'responseText' => 1
                ]);
            } catch (\Exception $exception) {
                return $resultJson->setData([
                    'messages' => $exception->getMessage(),
                    'responseText' => 0
                ]);
            }
        }
        return $resultJson->setData([
            'messages' => 'Document failed to remove.',
            'responseText' => 0
        ]);
    }
}
