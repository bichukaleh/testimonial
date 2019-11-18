<?php

namespace Ktpl\Managecomplaints\Block;

use Magento\Backend\Block\Widget\Container;
use Magento\Backend\Block\Widget\Context;

class Grid extends Container
{
    /**
     * Set Template
     * @var Magento\Framework\View\Result\PageFactory
     */
    protected $_template = 'grid/managecomplaints.phtml';

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
            $this->getLayout()->createBlock('Ktpl\Managecomplaints\Block\Grid\Index', 'grid.view.grid')
        );
        return parent::_prepareLayout();
    }

    /**
     * get html of grid
     * @return string
     */
    public function getGridHtml()
    {
        return $this->getChildHtml('grid');
    }
}
