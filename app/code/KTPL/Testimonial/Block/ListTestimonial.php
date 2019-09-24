<?php

namespace KTPL\Testimonial\Block;

use Magento\Framework\View\Element\Template;
use KTPL\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;
use KTPL\Testimonial\Model\ResourceModel\Testimonial\Collection;
class ListTestimonial extends Template
{
    protected $dataHelper;
    /**
     * ListTestimonial constructor.
     * @param Template\Context $context
     * @param CollectionFactory $testimonialFactory
     */
    public function __construct(Template\Context $context, CollectionFactory $testimonialFactory)
    {
        parent::__construct($context);
        $this->_testimonialFactory = $testimonialFactory;
    }

    /**
     * show data of testimonial table
     * @return \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    public function getTestimonialData()
    {
        $data = $this->_testimonialFactory->create();
        $collection = $data->addFieldToFilter('deleted_at', array('null' => true));

        return $collection;
    }

}
