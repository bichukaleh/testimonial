<?php

namespace Ktpl\Travelquote\Model\ResourceModel\Travelquote;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Bind model with resource model
     */
    protected function _construct()
    {
        $this->_init('Ktpl\Travelquote\Model\Travelquote', 'Ktpl\Travelquote\Model\ResourceModel\Travelquote');
    }
}
