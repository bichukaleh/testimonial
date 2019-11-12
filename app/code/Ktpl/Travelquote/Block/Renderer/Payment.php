<?php


namespace Ktpl\Travelquote\Block\Renderer;

use Ktpl\Travelquote\Model\Travelquote;
use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Backend\Helper\Data;
class Payment extends AbstractRenderer
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
     * Payment constructor.
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
     * Render payment dropdown
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $id = 'payment' . $row['id'];
        $singleId = $row['id'];
        $url = '"' . $this->_backendData->getUrl('ktpl_travelquote/action/edit') . '"';
        $options = $this->_travelquote->getPaymentTypeList();
        $html = "<select name='payment' class='admin__control-select payment' id='$id' onchange='updateRecord(this,$singleId,$url)'>";
        foreach ($options as $value => $option) {
            $selected = ($value == $row['payment']) ? 'selected="selected"' : '';
            $html .= "<option value='0' ></option>";
            $html .= "<option value='$value' {$selected}>$option</option>";
        }
        $html .= '</select>';
        return $html;
    }
}