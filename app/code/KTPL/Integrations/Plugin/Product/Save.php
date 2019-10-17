<?php

namespace KTPL\Integrations\Plugin\Product;

use Magento\Catalog\Controller\Adminhtml\Product\Save as ProductSave;

class Save
{
    public function beforeExecute(ProductSave $subject)
    {

        $productData = ["product" => $subject->getRequest()->getParam('product')];
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
       
        //API URL for authentication

        $apiURL = "http://10.16.16.187/magentodemo/index.php/rest/V1/integration/admin/token";

        //parameters passing with URL

        $data = array("username" => "admin", "password" => "admin123");

        $data_string = json_encode($data);

        $ch = curl_init($apiURL);

        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "Content-Length: " . strlen($data_string)));

        $token = curl_exec($ch);

        //decoding generated token and saving it in a variable

        $token = json_decode($token);

        $headers = array("Authorization: Bearer " . $token, "Content-Type: application/json");

        //API URL to get all Magento 2 modules

        $requestUrl = 'http://10.16.16.187/magentodemo/rest/V1/products/';

        $ch = curl_init($requestUrl);

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($productData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);

        //decoding result

        $result = json_decode($result);

    }
}