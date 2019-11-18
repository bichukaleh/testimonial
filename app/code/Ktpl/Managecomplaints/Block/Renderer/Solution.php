<?php

namespace Ktpl\Managecomplaints\Block\Renderer;

use Ktpl\Managecomplaints\Model\Managecomplaints;
use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Backend\Helper\Data;

class Solution extends AbstractRenderer
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
     * Solution constructor.
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
     * Render solution dropdown
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $id = 'solution' . $row['managecomplaints_id'];
        $singleId = $row['managecomplaints_id'];
        $url = '"' . $this->_backendData->getUrl('ktpl_managecomplaints/action/edit') . '"';
        $options = $this->_managecomplaints->getSolutionsOptions();
        $html = "<select name='solution' class='admin__control-select solution' id='$id' onchange='updateSolutionRecord(this,$singleId,$url)'>";
        foreach ($options as $value => $option) {
            $selected = ($value == $row['solution']) ? 'selected="selected"' : '';
            $html .= "<option value='$value' {$selected}>$option</option>";
        }
        $html .= '</select>';
        return $html;
    }
}
