<?php

namespace KTPL\Integrations\Plugin\Product;

use Magento\Catalog\Controller\Adminhtml\Product\Save as ProductSave;
use KTPL\Integrations\Helper\CurlRequest;
class Save
{
    /** @var KTPL\Integrations\Helper\CurlRequest */
    protected $_curlHelper;

    /**
     * Save constructor.
     * @param CurlRequest $curlRequest
     */
    public function __construct(\KTPL\Integrations\Helper\CurlRequest $curlRequest)
    {
        $this->_curlHelper = $curlRequest;
    }

    /**
     * function to call before execute method of product adding
     * @param ProductSave $subject
     */
    public function beforeExecute(ProductSave $subject)
    {
        // Authentication token
        $token = $this->_curlHelper->getAuthenticationToken();
        if ($token) {
            $productData = $subject->getRequest()->getParams();

            $specificProductData = [
                "sku" => $productData['product']['sku'],
                "name" => $productData['product']['name'],
                "price" => $productData['product']['price'],
                "weight" => floatval($productData['product']['weight']),
                "status" => $productData['product']['status'],
                "visibility" => $productData['product']['visibility'],
                "attribute_set_id" => $productData['product']['attribute_set_id'],
                "type_id" => $productData['type']
            ];
            unset($productData['product']);
            $productData['product'] = $specificProductData;
            $this->_curlHelper->saveDataUsingCurl('rest/V1/products/', $token, $productData);
        }
    }
}