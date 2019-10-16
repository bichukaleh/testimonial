<?php

namespace KTPL\Training\Block;

use Magento\Framework\View\Element\Template\Context;
use KTPL\Training\Model\Layer\Resolver;
use Magento\Catalog\Model\Layer\FilterList;
use Magento\Catalog\Model\Layer\AvailabilityFlagInterface;

class Navigation extends \Magento\LayeredNavigation\Block\Navigation
{
    /**
     * Navigation constructor.
     * @param Context $context
     * @param Resolver $layerResolver
     * @param FilterList $filterList
     * @param AvailabilityFlagInterface $visibilityFlag
     * @param array $data
     */
    public function __construct(Context $context, Resolver $layerResolver, FilterList $filterList, AvailabilityFlagInterface $visibilityFlag, array $data = [])
    {
        parent::__construct($context, $layerResolver, $filterList, $visibilityFlag);
    }
}