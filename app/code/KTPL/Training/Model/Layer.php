<?php

namespace KTPL\Training\Model;

use Magento\Catalog\Api\CategoryRepositoryInterface;
use Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory as AttributeCollectionFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Catalog\Model\Layer\ContextInterface;
use Magento\Catalog\Model\Layer\StateFactory;
use Magento\Catalog\Model\ResourceModel\Product;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Registry;
class Layer extends \Magento\Catalog\Model\Layer
{

    /**
     * Layer constructor.
     * @param ContextInterface $context
     * @param StateFactory $layerStateFactory
     * @param AttributeCollectionFactory $attributeCollectionFactory
     * @param Product $catalogProduct
     * @param StoreManagerInterface $storeManager
     * @param Registry $registry
     * @param CategoryRepositoryInterface $categoryRepository
     * @param CollectionFactory $productCollectionFactory
     * @param array $data
     */
    public function __construct(ContextInterface $context, StateFactory $layerStateFactory, AttributeCollectionFactory $attributeCollectionFactory,
        Product $catalogProduct, StoreManagerInterface $storeManager, Registry $registry, CategoryRepositoryInterface $categoryRepository, CollectionFactory $productCollectionFactory, array $data = []) {
        $this->productCollectionFactory = $productCollectionFactory;
        parent::__construct(
            $context,
            $layerStateFactory,
            $attributeCollectionFactory,
            $catalogProduct,
            $storeManager,
            $registry,
            $categoryRepository,
            $data
        );
    }

    /**
     * get product list
     * @return Product\Collection
     */
    public function getProductCollection()
    {
        if (isset($this->_productCollections['featured_products'])) {
            $collection = $this->_productCollections['featured_products'];
        } else {
            $collection = $this->productCollectionFactory->create();

            $this->prepareProductCollection($collection);
            $this->_productCollections['featured_products'] = $collection;
        }
        return $collection;
    }
}