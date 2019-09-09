<?php

namespace KTPL\Testimonial\Block\Adminhtml;

use KTPL\Testimonial\Model\TestimonialFactory;
use Magento\Framework\View\Element\Template;

class Ratings extends Template
{

    protected $testimonial;

    /**
     * Ratings constructor.
     * @param Template\Context $context
     * @param TestimonialFactory $testimonialFactory
     * @param array $data
     */
    public function __construct(Template\Context $context, TestimonialFactory $testimonialFactory, array $data = [])
    {
        $this->testimonial = $testimonialFactory;
        parent::__construct($context, $data);
    }

    /**
     * get testimonial rating numbers
     * @return mixed
     */
    public function getRatings()
    {
        $testimonial = $this->testimonial->create();
        $param = $this->getRequest()->getParam('testimonial_id');

        $testimonialData = $testimonial->getCollection()->addFieldToFilter('testimonial_id', ['eq' => $param])->getData();
        return isset($testimonialData[0]['ratings']) ? $testimonialData[0]['ratings'] : 5;
    }
}