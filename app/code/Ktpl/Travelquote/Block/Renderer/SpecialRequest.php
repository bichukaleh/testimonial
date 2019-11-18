<?php

namespace Ktpl\Travelquote\Block\Renderer;

use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;

class SpecialRequest extends AbstractRenderer
{
    /**
     * SpecialRequest constructor.
     * @param Context $context
     * @param array $data
     */
    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Render special request textarea
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $id = 'special_request' . $row['id'];
        $html = "<textarea name='special_request' id='$id' rows='8' cols='25' style='resize: none'>" . $row['special_request'] . "</textarea>";
        return $html;
    }
}
