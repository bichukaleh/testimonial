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
class DataProvider extends AbstractDataProvider
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
        $this->collection = $collectionFactory->create();
    }

    /**
     * @return array
     */
    public function getData()
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
        $currentStore = $storeManager->getStore();
        $media_url = $currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        if (isset($this->loadedData)) {
            return $this->loadedData;
        }

        $samples = $this->collection->getItems();
        $this->loadedData = [];
        foreach ($samples as $sample) {
            $this->loadedData[$sample->getId()] = $sample->getData();
            $fullData = $this->loadedData;
            $m['image'][0]['name'] =  $this->loadedData[$sample->getId()]['image'];
            $m['image'][0]['url'] =$media_url . 'testimonial/' . $this->loadedData[$sample->getId()]['image'];
            $this->loadedData[$sample->getId()] = array_merge($fullData[$sample->getId()], $m);
        }



        return $this->loadedData;

    }
}