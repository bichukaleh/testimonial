<?php

namespace Ktpl\Managecomplaints\Block\Renderer;

use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Backend\Helper\Data;
use Magento\Framework\DataObject;
use Magento\Sales\Api\Data\OrderInterface;

class OrderNumber extends AbstractRenderer
{
    /**
     * @var Data
     */
    protected $_backendHelper;

    /**
     * @var OrderInterface
     */
    protected $order;

    /**
     * OrderNumber constructor.
     * @param Context $context
     * @param Data $backendData
     * @param OrderInterface $order
     * @param array $data
     */
    public function __construct(Context $context, Data $backendData, OrderInterface $order, array $data = [])
    {
        $this->_backendHelper = $backendData;
        $this->order = $order;
        parent::__construct($context, $data);
    }

    /**
     * Render order number with link of order view
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $order = $this->order->loadByIncrementId($row['order_number']);
        $url = $this->_backendHelper->getUrl('sales/order/view/') . 'order_id/' . $order->getId();
        $html = "<a href='$url' target='_blank'>" . $row['order_number'] . "</a>";
        return $html;
    }
}
