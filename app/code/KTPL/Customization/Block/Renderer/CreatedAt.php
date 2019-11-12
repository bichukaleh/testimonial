<?php

namespace KTPL\Customization\Block\Renderer;

use Magento\Backend\Block\Context;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Backend\Helper\Data as BackendData;
class CreatedAt extends AbstractRenderer
{
    /**
     * @var StoreManagerInterface
     */
    protected $_storeManager;
    /**
     * @var BackendData
     */
    protected $_backendHelper;

    /**
     * Status constructor.
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param Data $dataHelper
     * @param array $data
     */
    public function __construct(Context $context, StoreManagerInterface $storeManager,BackendData $backendData, array $data = [])
    {
        parent::__construct($context, $data);
        $this->_storeManager = $storeManager;
        $this->_backendHelper = $backendData;
    }

    /**
     * render dropdown for status column
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $id = 'created_at' . $row['testimonial_id'];
        $url = $this->_backendHelper->getUrl('ktpl_customization/custom/edit');
        $singleId = $row['testimonial_id'];
        $html = "<input type='text' id='$id' data-url='$url' data-id='$singleId' class='field input-text admin__control-text required-entry' name='created_at' value='".date('d-m-Y',strtotime($row['created_at']))."'>";
        return $html;
    }
}