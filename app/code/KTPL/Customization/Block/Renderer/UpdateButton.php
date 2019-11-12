<?php

namespace KTPL\Customization\Block\Renderer;

use KTPL\Customization\Helper\Data;
use Magento\Backend\Block\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Backend\Helper\Data as BackendData;

class UpdateButton extends AbstractRenderer
{
    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var Data
     */
    protected $_dataHelper;

    /**
     * @var BackendData
     */
    protected $_backendHelper;

    /**
     * UpdateButton constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param Data $dataHelper
     * @param array $data
     */
    public function __construct(Context $context, StoreManagerInterface $storeManager, Data $dataHelper, BackendData $backendData, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
        $this->_dataHelper = $dataHelper;
        $this->_backendHelper = $backendData;
    }

    /**
     * render dropdown for status column
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $url = '"'.$this->_backendHelper->getUrl('ktpl_customization/custom/edit').'"';
        $singleId = $row['testimonial_id'];
        $ref="name".$singleId;
        $html = "<button onclick='updateRecord(this,$singleId,$url)' id='updateButton' class='updateButton' data-ref='$ref' data-id='$singleId'>Update</button>";
        return $html;
    }
}