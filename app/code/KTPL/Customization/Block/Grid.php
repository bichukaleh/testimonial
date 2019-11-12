<?php

namespace KTPL\Customization\Block;

use Magento\Backend\Block\Widget\Container;
use Magento\Backend\Block\Widget\Context;

class Grid extends Container
{
    /**
     * Set Template
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $_template = 'grid/view.phtml';

    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * Prepare Layout
     * @return Container
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    protected function _prepareLayout()
    {
        $this->setChild(
            'grid',
            $this->getLayout()->createBlock('KTPL\Customization\Block\Grid\Grid', 'grid.view.grid')
        );
        return parent::_prepareLayout();
    }

    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }
}
