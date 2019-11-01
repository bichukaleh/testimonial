<?php

namespace KTPL\Integrations\Plugin\Customer;

use KTPL\Integrations\Helper\CurlRequest;
class Save
{
    /** @var KTPL\Integrations\Helper\CurlRequest */
    protected $_curlHelper;

    /**
     * Save constructor.
     * @param CurlRequest $curlRequest
     */
    public function __construct(CurlRequest $curlRequest)
    {
        $this->_curlHelper = $curlRequest;
    }

    /**
     * function to call before execute method of customer adding
     * @param \Magento\Customer\Controller\Adminhtml\Index\Save $save
     */
    public function beforeExecute(\Magento\Customer\Controller\Adminhtml\Index\Save $save)
    {
        // Authentication token
        $token = $this->_curlHelper->getAuthenticationToken();
        if ($token) {
            //API URL to add customer
            $post = $save->getRequest()->getPostValue();
            unset($post['customer']['sendemail_store_id']);
            $post['customer']['gender'] = intval($post['customer']['gender']);

            $this->_curlHelper->saveDataUsingCurl('rest/V1/customers/', $token, $post);
        }
    }
}