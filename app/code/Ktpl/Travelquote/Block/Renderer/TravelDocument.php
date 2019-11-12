<?php

namespace Ktpl\Travelquote\Block\Renderer;

use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Backend\Helper\Data;

class TravelDocument extends AbstractRenderer
{
    /**
     * @var Data
     */
    protected $_backendData;

    /**
     * TravelDocument constructor.
     * @param Context $context
     * @param Data $backendData
     * @param array $data
     */
    public function __construct(Context $context, Data $backendData, array $data = [])
    {
        $this->_backendData = $backendData;
        parent::__construct($context, $data);
    }

    /**
     * Render travel document file upload
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $id = $row['id'];
        $url = $this->_backendData->getUrl('ktpl_travelquote/action/uploadfile');
        $html = '';
        if ($row['travel_document'] == "") {
            $divId='fileUploadForm1Div'.$id;
            $formId='fileUploadForm'.$id;
            $html .= '<div id="'.$divId.'"><form id="'.$formId.'" method="post" enctype="multipart/form-data" novalidate="novalidate">';
            $html .= "<input type='file' name='traveldocumentfile' id='$id'/>";
            $html .= "<button data-id='$id' data-url='$url' id='travelDocument1btnSubmit' class='custom-upload-btn'>Upload Document</button>";
            $html .= "</form></div>";
        } else {
            $divId='fileUploadForm1Div'.$id;
            $downloadUrl = $this->_backendData->getUrl('ktpl_travelquote/action/download') . 'id/' . $id . '/document/1';
            $removeLinkUrl =  $this->_backendData->getUrl('ktpl_travelquote/action/remove') . 'id/' . $id . '/document/1' ;
            $html .= "<div  id='$divId'><a href='$downloadUrl'>Download</a>";
            $html .= "<button data-url='$removeLinkUrl' id='removeDocument' class='removeDocument'  data-id='$id'>Remove</button>";
            $html .= "<div id='documentname'>". substr(strrchr($row['travel_document'],"/"),1)."</div></div>";
        }

        if ($row['travel_document2'] == "") {
            $divId='fileUploadForm2Div'.$id;
            $formId='fileUploadForm2'.$id;
            $html .= '<div id="'.$divId.'"> <form id="'.$formId.'" method="post" enctype="multipart/form-data" novalidate="novalidate">';
            $html .= "<input type='file' name='traveldocumentfile2' id='$id'/>";
            $html .= "<button data-id='$id' data-url='$url' id='travelDocument2btnSubmit' class='custom-upload-btn'>Upload Document</button>";
            $html .= "</form></div>";
        } else {
            $divId='fileUploadForm2Div'.$id;
            $downloadUrl = $this->_backendData->getUrl('ktpl_travelquote/action/download') . 'id/' . $id . '/document/2';
            $removeLinkUrl =  $this->_backendData->getUrl('ktpl_travelquote/action/remove') . 'id/' . $id . '/document/2';
            $html .= "<div id='$divId'><a href='$downloadUrl'>Download</a>";
            $html .= "<button data-url='$removeLinkUrl' id='removeDocument' class='removeDocument' data-id='$id'>Remove</button>";
            $html .= "<div id='documentname'>". substr(strrchr($row['travel_document2'],"/"),1)."</div></div>";
        }

        return $html;
    }
}
