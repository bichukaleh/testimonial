<?php

namespace Ktpl\Travelquote\Block\Renderer;

use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Backend\Helper\Data as BackendData;
use Magento\Framework\DataObject;

class DateLimit extends AbstractRenderer
{
    /**
     * @var BackendData
     */
    protected $_backendHelper;

    /**
     * DateLimit constructor.
     * @param Context $context
     * @param BackendData $backendData
     * @param array $data
     */
    public function __construct(Context $context, BackendData $backendData, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_backendHelper = $backendData;
    }

    /**
     * render date limit column
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $id = 'datelimit' . $row['id'];
        $url = $this->_backendHelper->getUrl('ktpl_travelquote/action/edit');
        $singleId = $row['id'];
        $date = $row['datelimit'] == '0000-00-00' ? '' : date('d-m-Y', strtotime($row['datelimit']));
        $html = "<input type='text' id='$id' data-url='$url' data-id='$singleId' class='field input-text admin__control-text required-entry' name='datelimit' value='" . $date . "'>";
        return $html;
    }
}
