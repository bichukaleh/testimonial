<?php

namespace KTPL\Integrations\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\HTTP\Adapter\CurlFactory;
use KTPL\Integrations\Helper\Data;
class CurlRequest extends \Magento\Framework\App\Helper\AbstractHelper
{
    /** @var \Magento\Framework\HTTP\Adapter\CurlFactory */
    protected $_curlFactory;

    /** @var \KTPL\Integrations\Helper\Data */
    protected $_configData;

    /**
     * CurlRequest constructor.
     * @param Context $context
     * @param CurlFactory $curlFactory
     * @param Data $data
     */
    public function __construct(Context $context, CurlFactory $curlFactory, Data $data)
    {
        $this->_curlFactory = $curlFactory;
        $this->_configData = $data;
        parent::__construct($context);
    }

    /**
     * get authentication token
     * @return mixed
     */
    public function getAuthenticationToken()
    {
        $allowIntegrations = $this->_configData->getGeneralConfig('enable');
        $adminCredentialAccess = $this->_configData->getGeneralConfig('admin_credentials');
        if ($allowIntegrations && $adminCredentialAccess) {
            try {
                $adminUserName = $this->_configData->getGeneralConfig('username');
                $adminPassword = $this->_configData->getGeneralConfig('password');
                $baseUrl = $this->_configData->getGeneralConfig('integration_with');

                //parameters passing with URL
                $data = ["username" => $adminUserName, "password" => $adminPassword];
                //API URL for authentication
                $url = $baseUrl . '/rest/V1/integration/admin/token';

                $curl = $this->_curlFactory->create();
                $header = ["Content-Type:application/json"];
                // pass headers and data
                $curl->write(\Zend_Http_Client::POST, $url, '\Zend_Http_Client::HTTP_0', $header, json_encode($data));
                $data = $curl->read();
                $data = preg_split('/^\r?$/m', $data, 2);
                $data = trim($data[1]);
                $curl->close();
                // check returned value is string
                if (is_string(json_decode($data))) {
                    return $data;
                }
            } catch (\Exception $exception) {
                return false;
            }
        }
        return false;
    }

    /**
     * Save data into M2 instance according to given URL
     * @param $url
     * @param $token
     * @param $data
     * @return bool
     */
    public function saveDataUsingCurl($url, $token, $data)
    {
        try {
            $baseUrl = $this->_configData->getGeneralConfig('integration_with');
            $url = $baseUrl . $url;
            $curl = $this->_curlFactory->create();
            $header = ["Content-Type:application/json","Authorization:Bearer " . json_decode($token)];
            // pass headers and data
            $curl->write(\Zend_Http_Client::POST, $url, '\Zend_Http_Client::HTTP_0', $header, json_encode($data));
            $curl->read();
            $curl->close();
            return true;
        } catch (\Exception $exception) {
            return false;
        }
    }
}