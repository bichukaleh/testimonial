<?php
namespace KTPL\Testimonial\Block\Adminhtml;
use Magento\Framework\View\Element\Template;

class Ratings extends Template{

    public function __construct(Template\Context $context, array $data = [])
    {
        parent::__construct($context, $data);
    }

    public function getRatings(){

        return 3;
    }
}