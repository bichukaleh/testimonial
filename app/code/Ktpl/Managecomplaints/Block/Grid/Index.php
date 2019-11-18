<?php

namespace Ktpl\Managecomplaints\Block\Grid;

use Ktpl\Managecomplaints\Model\Managecomplaints;
use Ktpl\Managecomplaints\Model\ResourceModel\Managecomplaints\CollectionFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Helper\Data;

class Index extends Extended
{
    /**
     * @var CollectionFactory
     */
    protected $_complaintsFactory;

    /**
     * @var Managecomplaints
     */
    protected $_managecomplaints;

    /**
     * Index constructor.
     * @param Context $context
     * @param Data $backendHelper
     * @param CollectionFactory $managecomplaintsFactory
     * @param Managecomplaints $managecomplaints
     * @param array $data
     */
    public function __construct(Context $context, Data $backendHelper, CollectionFactory $managecomplaintsFactory, Managecomplaints $managecomplaints, array $data = [])
    {
        $this->_complaintsFactory = $managecomplaintsFactory;
        $this->_managecomplaints = $managecomplaints;
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setDefaultSort('created_time');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = $this->_complaintsFactory->create();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * @return Extended|void
     * @throws \Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'managecomplaints_id',
            [
                'header' => __('Id'),
                'index' => 'managecomplaints_id',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'agent_responsible',
            [
                'header' => __('Agent'),
                'index' => 'agent_responsible',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'created_time',
            [
                'header' => __('Date'),
                'index' => 'created_time',
                'type' => 'date',
                'renderer' => '\Ktpl\Managecomplaints\Block\Renderer\CreatedTime'
            ]
        );
        $this->addColumn(
            'order_number',
            [
                'header' => __('Order Number'),
                'index' => 'order_number',
                'type' => 'text',
                'renderer' => '\Ktpl\Managecomplaints\Block\Renderer\OrderNumber'
            ]
        );
        $this->addColumn(
            'comment',
            [
                'header' => __('Comment Box'),
                'index' => 'comment',
                'type' => 'text',
                'renderer' => '\Ktpl\Managecomplaints\Block\Renderer\CommentBox'
            ]
        );
        $this->addColumn(
            'update',
            [
                'header' => __('Update'),
                'filter' => false,
                'sortable' => false,
                'renderer' => '\Ktpl\Managecomplaints\Block\Renderer\UpdateButton'
            ]
        );
        $this->addColumn(
            'solved',
            [
                'header' => __('Solved'),
                'index' => 'solved',
                'type' => 'options',
                'options'=>$this->_managecomplaints->getSolvedStatus(),
                'renderer' => '\Ktpl\Managecomplaints\Block\Renderer\Solved'
            ]
        );
        $this->addColumn(
            'solution',
            [
                'header' => __('Solution'),
                'index' => 'solution',
                'type' => 'options',
                'options'=>$this->_managecomplaints->getSolutionsOptions(),
                'renderer' => '\Ktpl\Managecomplaints\Block\Renderer\Solution'
            ]
        );
        $this->addColumn(
            'category',
            [
                'header' => __('Category'),
                'index' => 'category',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'client_name',
            [
                'header' => __('Client Name'),
                'index' => 'client_name',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'phone_number',
            [
                'header' => __('Phone Number'),
                'index' => 'phone_number',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'merchant_name',
            [
                'header' => __('Merchant Name'),
                'index' => 'merchant_name',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'responsible',
            [
                'header' => __('Responsible'),
                'index' => 'responsible',
                'type' => 'options',
                'options'=>$this->_managecomplaints->getResponsibleOptions(),
                'renderer' => '\Ktpl\Managecomplaints\Block\Renderer\Responsible'
            ]
        );
        $this->addColumn(
            'reason',
            [
                'header' => __('Reason'),
                'index' => 'reason',
                'type' => 'options',
                'options'=>$this->_managecomplaints->getReasons(),
                'renderer' => '\Ktpl\Managecomplaints\Block\Renderer\Reason'
            ]
        );
        $this->addColumn(
            'create_ticket',
            [
                'header' => __('Create Ticket'),
                'filter' => false,
                'sortable' => false,
                'renderer' => '\Ktpl\Managecomplaints\Block\Renderer\CreateTicket'
            ]
        );
        return parent::_prepareColumns();
    }
}
