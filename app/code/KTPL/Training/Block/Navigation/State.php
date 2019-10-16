<?php

namespace KTPL\Training\Block\Navigation;

use Magento\Framework\View\Element\Template\Context;
use KTPL\Training\Model\Layer\Resolver;
class State extends \Magento\LayeredNavigation\Block\Navigation\State
{
    /**
     * State constructor.
     * @param Context $context
     * @param Resolver $layerResolver
     * @param array $data
     */
    public function __construct(Context $context, Resolver $layerResolver, array $data = []) {
        parent::__construct($context, $layerResolver, $data);
    }
}