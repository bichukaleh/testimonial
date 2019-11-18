<?php

namespace Ktpl\Managecomplaints\Block\Renderer;

use Ktpl\Managecomplaints\Model\Managecomplaints;
use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Backend\Helper\Data;

class Responsible extends AbstractRenderer
{
    /**
     * @var Data
     */
    protected $_backendData;
    /**
     * @var Managecomplaints
     */
    protected $_managecomplaints;

    /**
     * Responsible constructor.
     * @param Context $context
     * @param Managecomplaints $managecomplaints
     * @param Data $backendData
     * @param array $data
     */
    public function __construct(Context $context, Managecomplaints $managecomplaints, Data $backendData, array $data = [])
    {
        $this->_managecomplaints = $managecomplaints;
        $this->_backendData = $backendData;
        parent::__construct($context, $data);
    }

    /**
     * Render responsible dropdown
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $id = 'responsible' . $row['managecomplaints_id'];
        $singleId = $row['managecomplaints_id'];
        $url = '"' . $this->_backendData->getUrl('ktpl_managecomplaints/action/edit') . '"';
        $options = $this->_managecomplaints->getResponsibleOptions();
        $html = "<select name='responsible' class='admin__control-select responsible' id='$id' onchange='updateResponsibleRecord(this,$singleId,$url)'>";
        foreach ($options as $value => $option) {
            $selected = ($value == $row['responsible']) ? 'selected="selected"' : '';
            $html .= "<option value='$value' {$selected}>$option</option>";
        }
        $html .= '</select>';
        return $html;
    }
}
