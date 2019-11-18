<?php

namespace Ktpl\Managecomplaints\Model\ResourceModel\Managecomplaints;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     * Bind model with resource model
     */
    protected function _construct()
    {
        $this->_init('Ktpl\Managecomplaints\Model\Managecomplaints', 'Ktpl\Managecomplaints\Model\ResourceModel\Managecomplaints');
    }
}
