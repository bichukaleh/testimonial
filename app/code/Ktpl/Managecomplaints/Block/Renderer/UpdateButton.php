<?php

namespace Ktpl\Managecomplaints\Block\Renderer;

use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Backend\Helper\Data;

class UpdateButton extends AbstractRenderer
{
    /**
     * @var Data
     */
    protected $_backendData;

    /**
     * UpdateButton constructor.
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
     * Render update button
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $id = $row['managecomplaints_id'];
        $url = '"' . $this->_backendData->getUrl('ktpl_managecomplaints/action/edit') . '"';
        $html = "<button data-id='$id' onclick='updateRecord(this,$id,$url)'>Update</button>";
        return $html;
    }
}
