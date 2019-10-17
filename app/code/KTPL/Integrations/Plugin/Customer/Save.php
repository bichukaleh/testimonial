<?php

namespace KTPL\Integrations\Plugin\Customer;

use Magento\Customer\Api\Data\GroupInterface;
use Magento\Framework\Api\ExtensionAttributesInterface\Config;
use Magento\Framework\HTTP\Client\Curl;
class Save
{
        /**
         * @var \Magento\Framework\HTTP\Client\Curl
        */
    protected $_curl;

    protected $_responseFactory;
    protected $_url;

    public function __construct(
        \Magento\Framework\App\ResponseFactory $responseFactory,
        \Magento\Framework\UrlInterface $url,
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        Curl $curl,
        array $data = []
    ) {
        $this->_curl = $curl;
        $this->_responseFactory = $responseFactory;
        $this->_url = $url;
    }

    public function beforeexecute(\Magento\Customer\Controller\Adminhtml\Index\Save $save)
    {
        $post = $save->getRequest()->getPostValue();
        //API URL for authentication
        
        //parameters passing with URL

        $data = array("username" => "admin", "password" => "admin123");
        

        $url = 'http://10.16.16.187/magentodemo/index.php/rest/V1/integration/admin/token';
         $this->_curl->addHeader('Content-Type','application/json');
        $this->_curl->post($url, json_encode($data));

        //response will contain the output in form of JSON string
        $response = $this->_curl->getBody();


        //decoding generated token and saving it in a variable

        $token = json_decode($response);

      
        //API URL to get all Magento 2 modules
        unset($post['customer']['sendemail_store_id']);
        $post['customer']['gender']=intval($post['customer']['gender']);
        
        $url = 'http://10.16.16.187/magentodemo/rest/V1/customers/';
        $this->_curl->addHeader('Content-Type','application/json');
        $this->_curl->addHeader('Authorization',"Bearer " . $token);
        $this->_curl->post($url, json_encode($post));

        //response will contain the output in form of JSON string
        // $response = $this->_curl->getBody();
    }
}