<?php
namespace KTPL\Testimonial\Model\ResourceModel;


class Testimonial extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

	public function __construct(
		\Magento\Framework\Model\ResourceModel\Db\Context $context
	)
	{
		parent::__construct($context);
	}

	protected function _construct()
	{
		$this->_init('ktpl_testimonial', 'testimonial_id');
	}

}