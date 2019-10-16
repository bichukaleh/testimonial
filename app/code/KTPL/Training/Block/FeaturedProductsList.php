<?php

namespace KTPL\Training\Block;

use Magento\Catalog\Model\ResourceModel\Collection\AbstractCollection;
use Magento\Catalog\Block\Product\ListProduct;
use Magento\Catalog\Block\Product\Context;
use Magento\Framework\Data\Helper\PostHelper;
use KTPL\Training\Model\Layer\Resolver;
use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Framework\Url\Helper\Data;
class FeaturedProductsList extends ListProduct
{
    protected $_data;
    protected $_productCollectionFactory;
    protected $eavConfig;
    protected $attribute;

    /**
     * FeaturedProductsList constructor.
     * @param Context $context
     * @param PostHelper $postDataHelper
     * @param Resolver $layerResolver
     * @param CategoryRepositoryInterface $categoryRepository
     * @param Data $urlHelper
     * @param array $data
     */
    public function __construct(Context $context, PostHelper $postDataHelper, Resolver $layerResolver, CategoryRepositoryInterface $categoryRepository, Data $urlHelper, array $data = []) {
        parent::__construct($context, $postDataHelper, $layerResolver, $categoryRepository, $urlHelper, $data);
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