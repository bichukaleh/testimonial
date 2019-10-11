<?php

namespace KTPL\Training\Block;

use Magento\Catalog\Model\ResourceModel\Collection\AbstractCollection;
use Magento\Catalog\Block\Product\ListProduct;
class FeaturedProductsList extends ListProduct
{
    protected $_data;
    protected $_productCollectionFactory;
    protected $eavConfig;
    protected $attribute;

    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Data\Helper\PostHelper $postDataHelper,
        \KTPL\Training\Model\Layer\Resolver $layerResolver,
        \Magento\Catalog\Api\CategoryRepositoryInterface $categoryRepository,
        \Magento\Framework\Url\Helper\Data $urlHelper,
        array $data = []
    ) {
        parent::__construct($context, $postDataHelper, $layerResolver,
            $categoryRepository, $urlHelper, $data);
    }
    /**
     * @return \Magento\Eav\Model\Entity\Collection\AbstractCollection
     */
    public function getLoadedProductCollection()
    {
        return $this->_productCollection;
    }

    /**
     * @param AbstractCollection $collection
     */
    public function setProductCollection(AbstractCollection $collection)
    {
        $this->_productCollection = $collection;
    }
}