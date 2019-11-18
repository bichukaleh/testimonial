<?php

namespace KTPL\Customization\Block\Testimonial;

use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data;
use Magento\Ui\Component\Listing\Columns\Column;
use KTPL\Customization\Block\Renderer\Status;

class Testimonial extends Extended
{
    public function __construct(Context $context, Data $backendHelper, array $data = [])
    {
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _prepareColumns()
    {


        $this->addColumn('is_approved', [
            'header' => __('Status'),
            'index' => 'is_approved',
            'type' => 'options',
            'options' => Status::getAvailableStatus(),
            'renderer' => KTPL\Customization\Block\Renderer\Status::class
        ]);
        return $this;
    }
}
