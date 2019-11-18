<?php

namespace Ktpl\Managecomplaints\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
class Managecomplaints extends AbstractDb
{
    /**
     * Managecomplaints constructor.
     * @param Context $context
     */
    public function __construct(Context $context)
    {
        parent::__construct($context);
    }

    /**
     * Resource initialization
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('managecomplaints', 'managecomplaints_id');
    }
}
