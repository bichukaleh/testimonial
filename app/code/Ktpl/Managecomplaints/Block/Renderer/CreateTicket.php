<?php

namespace Ktpl\Managecomplaints\Block\Renderer;

use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Framework\DataObject;
use Magento\Backend\Helper\Data;
use Magento\Sales\Api\Data\OrderInterface;

class CreateTicket extends AbstractRenderer
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
     * CreateTicket constructor.
     * @param Context $context
     * @param array $data
     */
    public function __construct(Context $context, Data $backendData, OrderInterface $order, array $data = [])
    {
        $this->_backendHelper = $backendData;
        $this->order = $order;
        parent::__construct($context, $data);
    }

    /**
     * Render Create Ticket button
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $order = $this->order->loadByIncrementId($row['order_number']);
        $url = '"' . $this->_backendHelper->getUrl('zendesk/create/') . 'order_id/' . $order->getId() . '"';
        $target = '"' . '_blank' . '"';
        $html = "<button onclick='window.open($url,$target)'>Create Ticket</button>";
        return $html;
    }
}
