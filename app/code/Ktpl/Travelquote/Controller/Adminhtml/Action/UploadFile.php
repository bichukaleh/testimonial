<?php

namespace Ktpl\Travelquote\Controller\Adminhtml\Action;

use Ktpl\Travelquote\Model\TravelquoteFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Backend\Helper\Data;

class UploadFile extends Action
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
     * @var Data
     */
    protected $_backendData;

    /**
     * UploadFile constructor.
     * @param Context $context
     * @param JsonFactory $jsonFactory
     * @param TravelquoteFactory $travelquoteFactory
     * @param UploaderFactory $uploaderFactory
     * @param Filesystem $filesystem
     * @throws \Magento\Framework\Exception\FileSystemException
     */
    public function __construct(Context $context, JsonFactory $jsonFactory, TravelquoteFactory $travelquoteFactory, UploaderFactory $uploaderFactory, Filesystem $filesystem, Data $backendData)
    {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->_travelquoteFactory = $travelquoteFactory;
        $this->__uploadFactory = $uploaderFactory;
        $this->_fileSystem = $filesystem;
        $this->_mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        $this->_backendData = $backendData;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $postData = $this->getRequest()->getParams();
        $resultJson = $this->jsonFactory->create();
        try {

            if (isset($postData['document']) && $postData['document'] == '2') {
                $document = 'traveldocument2';
                $key = 'traveldocumentfile2';
                $inputKey = 'travel_document2';
                $uploader = $this->__uploadFactory->create(['fileId' => 'traveldocumentfile2']);
            } else {
                $document = 'traveldocument1';
                $key = 'traveldocumentfile';
                $inputKey = 'travel_document';
                $uploader = $this->__uploadFactory->create(['fileId' => 'traveldocumentfile']);
            }
            $target = $this->_mediaDirectory->getAbsolutePath('travelquote/' . $document);

            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(true);
            $uploader->setAllowCreateFolders(true);

            $result = $uploader->save($target);

            if ($id = $this->getRequest()->getParam('id')) {
                $input[$inputKey] = $result['file'];
                $input['id'] = $id;
                $travelquote = $this->_travelquoteFactory->create();
                $travelquote->setId($id)->setData($input)->save();
            }

            $downloadUrl = $this->_backendData->getUrl('ktpl_travelquote/action/download') . 'id/' . $id . '/document/' . $postData['document'];
            $removeLinkUrl = $this->_backendData->getUrl('ktpl_travelquote/action/remove') . 'id/' . $id . '/document/' . $postData['document'];
            $divId = 'fileUploadForm' . $postData['document'] . 'Div' . $id;
            $html = "<div id='$divId'><a href='$downloadUrl'>Download</a>";
            $html .= "<button data-url='$removeLinkUrl' id='removeDocument' class='removeDocument' data-id='$id'>Remove</button>";
            $html .= "<div id='documentname'>" . substr(strrchr($result['file'], "/"), 1) . "</div></div>";

            return $resultJson->setData([
                'messages' => 'Document uploaded successfully.',
                'content' => $html,
                'responseText' => 1
            ]);
        } catch (\Exception $exception) {
            return $resultJson->setData([
                'messages' => $exception->getMessage(),
                'responseText' => $exception->getFile(),
                'error' => $exception->getCode()
            ]);
        }
    }
}
