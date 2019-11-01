<?php
namespace KTPL\Admin\Model\ResourceModel\Admin;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected $_eventPrefix = 'ktpl_admin_login_logs_collection';
    protected $_eventObject = 'ktpl_admin_login_logs_collection';

	/**
	 * Define resource model
	 *
	 * @return void
	 */
	protected function _construct()
	{
		$this->_init('KTPL\Admin\Model\AdminLog', 'KTPL\Admin\Model\ResourceModel\AdminLog');
	}


}