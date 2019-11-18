<?php

namespace Ktpl\Travelquote\Block\Renderer;

use Ktpl\Travelquote\Model\Travelquote;
use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
class Child extends AbstractRenderer
{
    /**
     * @var Travelquote
     */
    protected $_travelquote;

    /**
     * Child constructor.
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
     * Render Child dropdown
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $status = $this->_travelquote->getNumberOfPersons();
        $html = $status[$row['teen']];
        return $html;
    }
}