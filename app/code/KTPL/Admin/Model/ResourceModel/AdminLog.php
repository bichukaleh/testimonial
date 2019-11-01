<?php
namespace KTPL\Admin\Model\ResourceModel;


class AdminLog extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}

	protected function _construct()
	{
		$this->_init('ktpl_admin_login_logs', 'entity_id');
	}

}