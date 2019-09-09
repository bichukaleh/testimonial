<?php

namespace KTPL\Testimonial\Block\Adminhtml;

use Magento\Framework\View\Element\Template;
use KTPL\Testimonial\Model\ResourceModel\Testimonial\CollectionFactory;

class Image extends Template
{

    protected $_testimonialFactory;
    protected $_fileSystem;

    public function __construct(Template\Context $context, CollectionFactory $testimonialFactory, array $data = [])
    {
        $this->_testimonialFactory = $testimonialFactory->create();
        parent::__construct($context, $data);
    }

    /**
     * get path of testimonial image
     * @return string
     */
    public function getImagePath()
    {
        $testimonialId = $this->getRequest()->getParam('testimonial_id');

        $testimonail = $this->_testimonialFactory->addFieldToFilter('testimonial_id', ['eq' => $testimonialId]);
        $testimonail = $testimonail->getData();
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
        $currentStore = $storeManager->getStore();
        $media_url = $currentStore->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $imagePath = $media_url . 'testimonial/' . $testimonail[0]['image'];

        return array('fullPath'=>$imagePath,'name'=>$testimonail[0]['image']);

    }
}