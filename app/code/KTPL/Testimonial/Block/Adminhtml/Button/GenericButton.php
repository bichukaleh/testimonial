<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace KTPL\Testimonial\Block\Adminhtml\Button;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class GenericButton
 */
class GenericButton
{
    protected $context;


    /**
     * @param Context $context
     */
    public function __construct(Context $context) {
        $this->context = $context;
    }

    /**
     * Return Testimonial id
     *
     * @return int|null
     */
    public function getTestimonialId()
    {
        try {
            return $this->context->getRequest()->getParam('testimonial_id');
        } catch (NoSuchEntityException $e) {
        }
        return null;
    }

    /**
     * Generate url by route and parameters
     *
     * @param   string $route
     * @param   array $params
     * @return  string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
