<?php

namespace KTPL\Testimonial\Block;

use Magento\Framework\View\Element\Template;

class Testimonial extends Template
{
    /**
     * Testimonial constructor.
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    /**
     * get url of save function
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('testimonial/index/testimonial');
    }
}
