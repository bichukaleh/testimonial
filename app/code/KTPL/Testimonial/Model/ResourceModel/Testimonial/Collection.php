<?php

namespace KTPL\Testimonial\Model\ResourceModel\Testimonial;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected $_idFieldName = 'testimonial_id';
    protected $_eventPrefix = 'ktpl_testimonial_collection';
    protected $_eventObject = 'testimonial_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('KTPL\Testimonial\Model\Testimonial', 'KTPL\Testimonial\Model\ResourceModel\Testimonial');
    }


}