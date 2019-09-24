<?php

namespace KTPL\Testimonial\Block;

use Magento\Framework\View\Element\Template;
use KTPL\Testimonial\Model\TestimonialFactory;

class ListTestimonial extends Template
{
    /**
     * ListTestimonial constructor.
     * @param Template\Context $context
     * @param TestimonialFactory $testimonialFactory
     */
    public function __construct(Template\Context $context, TestimonialFactory $testimonialFactory)
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
        $collection = $data->getCollection();
        return $collection;
    }

}
