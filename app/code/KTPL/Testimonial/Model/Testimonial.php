<?php
namespace KTPL\Testimonial\Model;
class Testimonial extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface
{
	const CACHE_TAG = 'KTPL_testimonial_testimonial';

	protected $_cacheTag = 'KTPL_testimonial_testimonial';

	protected $_eventPrefix = 'KTPL_testimonial_testimonial';

	protected function _construct()
	{
		$this->_init('KTPL\Testimonial\Model\ResourceModel\Testimonial');
	}

	public function getIdentities()
	{
		return [self::CACHE_TAG . '_' . $this->getId()];
	}

	public function getDefaultValues()
	{
		$values = [];

		return $values;
	}
}