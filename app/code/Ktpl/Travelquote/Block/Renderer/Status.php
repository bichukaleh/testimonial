<?php

namespace Ktpl\Travelquote\Block\Renderer;

use Ktpl\Travelquote\Model\Travelquote;
use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Backend\Helper\Data;
use Magento\Framework\DataObject;

class Status extends AbstractRenderer
{
    /**
     * @var Data
     */
    protected $_backendData;
    /**
     * @var Travelquote
     */
    protected $_travelquote;

    /**
     * Status constructor.
     * @param Context $context
     * @param Travelquote $travelquote
     * @param Data $backendData
     * @param array $data
     */
    public function __construct(Context $context, Travelquote $travelquote, Data $backendData, array $data = [])
    {
        $this->_travelquote = $travelquote;
        $this->_backendData = $backendData;
        parent::__construct($context, $data);
    }

    /**
     * Render status dropdown
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $id = 'status' . $row['id'];
        $singleId = $row['id'];
        $url = '"' . $this->_backendData->getUrl('ktpl_travelquote/action/edit') . '"';
        $options = $this->_travelquote->getStatus();
        $html = "<select name='status' class='admin__control-select status' id='$id' onchange='updateRecord(this,$singleId,$url)'>";
        foreach ($options as $value => $option) {
            $selected = ($value == $row['status']) ? 'selected="selected"' : '';
            $html .= "<option value='0' ></option>";
            $html .= "<option value='$value' {$selected}>$option</option>";
        }
        $html .= '</select>';
        return $html;
    }
}
