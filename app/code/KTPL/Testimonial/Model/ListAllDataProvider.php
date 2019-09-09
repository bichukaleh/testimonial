<?php
/**
 * File: DataProvider.php
 *
 * @author      KTPL
 * Github:      https://github.com/maciejslawik
 */

namespace KTPL\Testimonial\Model;

use KTPL\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;
use KTPL\Testimonial\Model\ResourceModel\Testimonial\Collection;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\Filesystem;

//This is the data provider implementation for the form UI component.

/**
 * Class DataProvider
 * @package Training\Testimonial\Model\Sample
 */
class ListAllDataProvider extends AbstractDataProvider
{
    protected $fileSystem;

    /**
     * DataProvider constructor.
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    )
    {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        /** @var Collection collection */
        $this->collection = $collectionFactory->create()->addFieldToFilter('deleted_at',['null'=>true]);
    }

    /**
     * @return array
     */
    public function getCollection()
    {
        return $this->collection->setOrder('testimonial_id','DESC');

    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }
        $collection=$this->getCollection()->toArray();

        return $collection;
    }
}