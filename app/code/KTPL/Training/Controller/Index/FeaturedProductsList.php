<?php

namespace KTPL\Training\Controller\Index;

use Magento\Backend\Model\UrlInterface;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Model\ResourceModel\Product\CollectionFactory;
use Magento\Framework\App\Request\Http;
class FeaturedProductsList extends Action
{
    protected $_pageFactory;
    protected $url;
    protected $productCollection;
    protected $request;

    /**
     * FeaturedProductsList constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param UrlInterface $url
     * @param CollectionFactory $collectionFactory
     * @param Http $request
     */
    public function __construct(Context $context, PageFactory $pageFactory, UrlInterface $url, CollectionFactory $collectionFactory, Http $request)
    {
        $this->_pageFactory = $pageFactory;
        $this->resultRedirectFactory = $context->getResultRedirectFactory();
        $this->resultFactory = $context->getResultFactory();
        $this->url = $url;
        $this->productCollection = $collectionFactory->create();
        $this->request = $request;
        parent::__construct($context);
    }

    /**
     * @return ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $filters = $this->request->getParams();
        $pageFactory = $this->_pageFactory->create();
        $this->productCollection->addFieldToSelect('*');
        $this->productCollection->addFieldToFilter('featured_products', ['eq' => 1]);
        $list = $pageFactory->getLayout()->getBlock('featured_products');

        // filter collection as per parameters
        if (isset($filters) && $filters != "" && is_array($filters)) {
            foreach ($filters as $column => $value) {
                if (strpos($value, '-')) {
                    $values = explode('-', $value);
                    $this->productCollection->addFieldToFilter($column, ['gt' => $values[0]]);
                    $this->productCollection->addFieldToFilter($column, ['lt' => $values[1]]);
                } elseif ($column == 'product_list_order' || $column == 'product_list_dir') {
                    if (key_exists('product_list_dir', $filters) && isset($filters['product_list_order'])) {
                        $this->productCollection->addOrder($filters['product_list_order'], $filters['product_list_dir']);
                    } else {
                        $this->productCollection->addOrder($value, 'desc');
                    }
                } elseif ($column == "product_list_limit") {
                    if (isset($filters['p'])) {
                        $currentPage = $filters['p'];
                    } else {
                        $currentPage = 1;
                    }
                    $this->productCollection->setPageSize(1)->setCurPage(1);
                } else if ($column == "cat") {
                    $catIds = explode(',', $value);
                    $this->productCollection->addCategoriesFilter(array('in' => $catIds));
                } else {
                    if (!$column == 'p') {
                        $this->productCollection->addFieldToFilter($column, ['eq' => $value]);
                    }
                }

            }
        }

        $list->setProductCollection($this->productCollection);

        $pageFactory->getConfig()->getTitle()->set("Featured Products List");
        return $pageFactory;
    }
}