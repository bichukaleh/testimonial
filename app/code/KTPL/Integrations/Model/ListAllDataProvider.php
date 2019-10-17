<?php

namespace KTPL\Admin\Model;

use Magento\Ui\DataProvider\AbstractDataProvider;
use KTPL\Admin\Model\ResourceModel\Admin\CollectionFactory;
class ListAllDataProvider extends AbstractDataProvider
{
    protected  $adminLogFactory;

    public function __construct($name, $primaryFieldName, $requestFieldName, CollectionFactory $adminLogFactory ,array $meta = [], array $data = [])
    {
        $this->adminLogFactory=$adminLogFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    /**
     * @return array
     */
    public function getCollection()
    {
        return $this->adminLogFactory;

    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        $collection=$this->getCollection()->toArray();
        return $collection;
    }
}