<?php

namespace Ktpl\Travelquote\Block\Grid;

use Ktpl\Travelquote\Model\Travelquote;
use Ktpl\Travelquote\Model\ResourceModel\Travelquote\CollectionFactory;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Helper\Data;

class Index extends Extended
{
    /**
     * @var CollectionFactory
     */
    protected $_travelquoteCollection;
    /**
     * @var Travelquote
     */
    protected $_travelquote;

    /**
     * Index constructor.
     * @param Context $context
     * @param Data $backendHelper
     * @param CollectionFactory $collectionFactory
     * @param Travelquote $travelquote
     * @param array $data
     */
    public function __construct(Context $context, Data $backendHelper, CollectionFactory $collectionFactory, Travelquote $travelquote, array $data = [])
    {
        $this->_travelquoteCollection=$collectionFactory;
        $this->_travelquote=$travelquote;
        parent::__construct($context, $backendHelper, $data);
    }

    /**
     * change default sort order
     */
    protected function _construct()
    {
        parent::_construct();
        $this->setDefaultSort('id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
    }

    /**
     * @return Extended
     */
    protected function _prepareCollection()
    {
        $collection = $this->_travelquoteCollection->create();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    /**
     * prepare grid columns
     * @return Extended
     * @throws \Exception
     */
    protected function _prepareColumns()
    {
        $this->addColumn(
            'id',
            [
                'header' => __('Id'),
                'index' => 'id',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'date',
            [
                'header' => __('Date'),
                'index' => 'date',
                'type' => 'date'
            ]
        );
        $this->addColumn(
            'agent',
            [
                'header' => __('Agent'),
                'index' => 'agent',
                'type' => 'options',
                'options'=>$this->_travelquote->getAgentList(),
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\Agent'
            ]
        );
        $this->addColumn(
            'status',
            [
                'header' => __('Status'),
                'index' => 'status',
                'type' => 'options',
                'options'=>$this->_travelquote->getStatus(),
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\Status'
            ]
        );
        $this->addColumn(
            'action_time',
            [
                'header' => __('Action Time'),
                'index' => 'action_time',
                'type' => 'date',
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\ActionTime'
            ]
        );
        $this->addColumn(
            'agent_comment',
            [
                'header' => __('Agent Comment'),
                'index' => 'agent_comment',
                'type' => 'text',
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\AgentComment'
            ]
        );
        $this->addColumn(
            'update_agent_comment',
            [
                'header' => __('Update'),
                'filter' => false,
                'sortable' => false,
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\UpdateButton'
            ]
        );
        $this->addColumn(
            'package',
            [
                'header' => __('Package'),
                'index' => 'package',
                'type' => 'text',
            ]
        );
        $this->addColumn(
            'sku',
            [
                'header' => __('SKU'),
                'index' => 'sku',
                'type' => 'text',
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\SKU'
            ]
        );
        $this->addColumn(
            'firstname',
            [
                'header' => __('First Name'),
                'index' => 'firstname',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'lastname',
            [
                'header' => __('Last Name'),
                'index' => 'lastname',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'mobile',
            [
                'header' => __('Mobile'),
                'index' => 'mobile',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'email',
            [
                'header' => __('Email'),
                'index' => 'email',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'flexible_date',
            [
                'header' => __('Flexible Date'),
                'index' => 'flexible_date',
                'type' => 'options',
                'options'=>$this->_travelquote->getStatusOfFlexibleDate(),
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\FlexibleDate'
            ]
        );
        $this->addColumn(
            'departure',
            [
                'header' => __('Departure'),
                'index' => 'departure',
                'type' => 'date',
            ]
        );
        $this->addColumn(
            'return',
            [
                'header' => __('Return'),
                'index' => 'return',
                'type' => 'date',
            ]
        );
        $this->addColumn(
            'adult',
            [
                'header' => __('Adult 18+'),
                'index' => 'adult',
                'type' => 'options',
                'options'=>$this->_travelquote->getNumberOfAdults(),
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\Adult'
            ]
        );
        $this->addColumn(
            'teen',
            [
                'header' => __('Teen <18'),
                'index' => 'teen',
                'type' => 'options',
                'options'=>$this->_travelquote->getNumberOfPersons(),
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\Teen'
            ]
        );
        $this->addColumn(
            'child',
            [
                'header' => __('Child < 12'),
                'index' => 'child',
                'type' => 'options',
                'options'=>$this->_travelquote->getNumberOfPersons(),
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\Child'
            ]
        );
        $this->addColumn(
            'infant',
            [
                'header' => __('Infant < 2'),
                'index' => 'infant',
                'type' => 'options',
                'options'=>$this->_travelquote->getNumberOfPersons(),
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\Infant'
            ]
        );
        $this->addColumn(
            'customer_comment',
            [
                'header' => __('Customer Comment'),
                'index' => 'customer_comment',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'datelimit',
            [
                'header' => __('Date Limit'),
                'index' => 'datelimit',
                'type' => 'date',
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\DateLimit'
            ]
        );
        $this->addColumn(
            'payment',
            [
                'header' => __('Payment'),
                'index' => 'payment',
                'type' => 'options',
                'options'=>$this->_travelquote->getPaymentTypeList(),
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\Payment'
            ]
        );
        $this->addColumn(
            'travel_document',
            [
                'header' => __('Travel Document'),
                'filter' => false,
                'sortable' => false,
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\TravelDocument'
            ]
        );
        $this->addColumn(
            'special_request',
            [
                'header' => __('Special Request'),
                'index' => 'special_request',
                'type' => 'text',
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\SpecialRequest'
            ]
        );
        $this->addColumn(
            'update',
            [
                'header' => __('Update'),
                'filter' => false,
                'sortable' => false,
                'renderer' => '\Ktpl\Travelquote\Block\Renderer\UpdateButton'
            ]
        );
        return parent::_prepareColumns();
    }
}
