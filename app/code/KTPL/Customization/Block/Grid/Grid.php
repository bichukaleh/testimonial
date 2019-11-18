<?php

namespace KTPL\Customization\Block\Grid;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Grid\Extended;
use KTPL\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;
use Magento\Backend\Helper\Data;
use KTPL\Customization\Helper\Data as DataHelper;
class Grid extends Extended
{

    /**
     * @var DataHelper
     */
    protected $_dataHelper;
    /**
     * Grid constructor.
     * @param CollectionFactory $testimonialCollection
     * @param Context $context
     * @param Data $backendHelper
     * @param array $data
     */
    public function __construct(CollectionFactory $testimonialCollection, Data $backendHelper, DataHelper $dataHelper,Context $context, array $data = [])
    {
        $this->_testimonialGridCollection = $testimonialCollection;
        $this->_dataHelper = $dataHelper;
        parent::__construct($context, $backendHelper, $data);
    }
    protected function _construct()
    {
        parent::_construct();
        $this->setId('testimonial_id');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }
    /**
     * @return Extended
     */
    protected function _prepareCollection()
    {
        $collection = $this->_testimonialGridCollection->create();
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
            'testimonial_id',
            [
                'header' => __('Id'),
                'index' => 'testimonial_id',
                'type' => 'text'
            ]
        );
        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'index' => 'name',
                'type' => 'text',
                'renderer' => '\KTPL\Customization\Block\Renderer\Name'
            ]
        );
        $this->addColumn(
            'update',
            [
                'header' => __('Update'),
                'filter'=>false,
                'sortable'=>false,
                'renderer' => '\KTPL\Customization\Block\Renderer\UpdateButton'
            ]
        );
        $this->addColumn(
            'is_approved',
            [
                'header' => __('Status'),
                'index' => 'is_approved',
                'type' => 'options',
                'options'   => $this->_dataHelper->getStatus(),
                'class' => 'admin__control-select',
                'renderer' => '\KTPL\Customization\Block\Renderer\Status'
            ]
        );
        $this->addColumn(
            'created_at',
            [
                'header' => __('Created On'),
                'index' => 'created_at',
                'type' => 'datetime',
                'renderer' => '\KTPL\Customization\Block\Renderer\CreatedAt'
            ]
        );
        $block = $this->getLayout()->getBlock('grid.bottom.links');
        if ($block) {
            $this->setChild('grid.bottom.links', $block);
        }
        return parent::_prepareColumns();
    }
}
