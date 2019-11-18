<?php

namespace Ktpl\Travelquote\Block\Renderer;

use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Ktpl\Travelquote\Model\Travelquote;

class FlexibleDate extends AbstractRenderer
{
    /**
     * @var Travelquote
     */
    protected $_travelquote;

    /**
     * FlexibleDate constructor.
     * @param Context $context
     * @param Travelquote $travelquote
     * @param array $data
     */
    public function __construct(Context $context, Travelquote $travelquote, array $data = [])
    {
        $this->_travelquote = $travelquote;
        parent::__construct($context, $data);
    }

    /**
     * Render date in given format
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $status = $this->_travelquote->getStatusOfFlexibleDate();
        $html = $status[$row['flexible_date']];
        return $html;
    }
}
