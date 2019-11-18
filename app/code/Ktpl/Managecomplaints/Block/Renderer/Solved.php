<?php

namespace Ktpl\Managecomplaints\Block\Renderer;

use Ktpl\Managecomplaints\Model\Managecomplaints;
use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Backend\Helper\Data;
class Solved extends AbstractRenderer
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
     * Solved constructor.
     * @param Context $context
     * @param Managecomplaints $managecomplaints
     * @param array $data
     */
    public function __construct(Context $context, Managecomplaints $managecomplaints, Data $backendData, array $data = [])
    {
        $this->_managecomplaints = $managecomplaints;
        $this->_backendData = $backendData;
        parent::__construct($context, $data);
    }

    /**
     * Render solved dropdown
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $id = 'solved' . $row['managecomplaints_id'];
        $singleId = $row['managecomplaints_id'];
        $url = '"' . $this->_backendData->getUrl('ktpl_managecomplaints/action/edit') . '"';
        $options = $this->_managecomplaints->getSolvedStatus();
        $html = "<select name='status' class='admin__control-select solved' id='$id' onchange='updateSolvedRecord(this,$singleId,$url)'>";
        foreach ($options as $value => $option) {
            $selected = ($value == $row['solved']) ? 'selected="selected"' : '';
            $html .= "<option value='$value' {$selected}>$option</option>";
        }
        $html .= '</select>';
        return $html;
    }
}
