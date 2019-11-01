<?php

namespace KTPL\Admin\Model;


class AdminLog extends \Magento\Framework\Model\AbstractModel
{
    const CACHE_TAG = 'ktpl_admin_login_logs_collection';

    protected $_cacheTag = 'ktpl_admin_login_logs_collection';

    public $_eventPrefix = 'ktpl_admin_login_logs_collection';

    protected function _construct()
    {
        $this->_init('KTPL\Admin\Model\ResourceModel\AdminLog');
    }
}