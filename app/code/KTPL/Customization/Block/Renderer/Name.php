<?php

namespace KTPL\Customization\Block\Renderer;

use KTPL\Customization\Helper\Data;
use Magento\Backend\Block\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;

class Name extends AbstractRenderer
{
    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;

    /**
     * @var Data
     */
    protected $_dataHelper;

    /**
     * Status constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param Data $dataHelper
     * @param array $data
     */
    public function __construct(Context $context, StoreManagerInterface $storeManager, Data $dataHelper, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
        $this->_dataHelper = $dataHelper;
    }

    /**
     * render dropdown for status column
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $id = 'name' . $row['testimonial_id'];
        $value=$row['name'];
        $html ="<input type='text' name='name' id='$id' class='input-text admin__control-text' value='$value'>";
        return $html;
    }
}