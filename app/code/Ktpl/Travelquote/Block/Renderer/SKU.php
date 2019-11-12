<?php

namespace Ktpl\Travelquote\Block\Renderer;

use Magento\Backend\Block\Context;
use Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer;
use Magento\Backend\Helper\Data;
use Magento\Framework\DataObject;
use Magento\Catalog\Model\ProductFactory;

class SKU extends AbstractRenderer
{
    /**
     * @var Data
     */
    protected $_backendHelper;

    /**
     * @var $productRepository
     */
    protected $_productFactory;

    /**
     * SKU constructor.
     * @param Context $context
     * @param Data $backendData
     * @param ProductFactory $productFactory
     * @param array $data
     */
    public function __construct(Context $context, Data $backendData, ProductFactory $productFactory, array $data = [])
    {
        $this->_backendHelper = $backendData;
        $this->_productFactory = $productFactory;
        parent::__construct($context, $data);
    }

    /**
     * Render sku with link of product view
     * @param DataObject $row
     * @return string
     */
    public function render(DataObject $row)
    {
        $product = $this->_productFactory->create();
        $productId = $product->getIdBySku($row['sku']);
        $url = $this->_backendHelper->getUrl('catalog/product/edit/id') . 'id/' . $productId;
        $html = "<a href='$url' target='_blank'>" . $row['sku'] . "</a>";
        return $html;
    }
}
