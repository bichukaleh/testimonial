<?php

namespace KTPL\Training\Model\Layer;

use Magento\Framework\ObjectManagerInterface;
use KTPL\Training\Model\Layer;
class Resolver extends \Magento\Catalog\Model\Layer\Resolver
{
    /**
     * Resolver constructor.
     * @param ObjectManagerInterface $objectManager
     * @param Layer $layer
     * @param array $layersPool
     */
    public function __construct(ObjectManagerInterface $objectManager, Layer $layer, array $layersPool)
    {
        $this->layer = $layer;
        parent::__construct($objectManager, $layersPool);
    }

}