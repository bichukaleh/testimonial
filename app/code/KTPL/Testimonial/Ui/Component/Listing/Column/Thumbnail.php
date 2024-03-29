<?php
 namespace KTPL\Testimonial\Ui\Component\Listing\Column;

 use Magento\Catalog\Helper\Image;
 use Magento\Framework\UrlInterface;
 use Magento\Framework\View\Element\UiComponentFactory;
 use Magento\Framework\View\Element\UiComponent\ContextInterface;
 use Magento\Store\Model\StoreManagerInterface;
 use Magento\Ui\Component\Listing\Columns\Column;

 class Thumbnail extends Column{

     const ALT_FIELD='image';

     protected $storeManager;

     public function __construct(
         ContextInterface $context,
         UiComponentFactory $uiComponentFactory,
         Image $imageHelper,
         UrlInterface $urlBuilder,
         StoreManagerInterface $storeManager,
         array $components = [],
         array $data = []
     ) {
         $this->storeManager = $storeManager;
         $this->imageHelper = $imageHelper;
         $this->urlBuilder = $urlBuilder;
         parent::__construct($context, $uiComponentFactory, $components, $data);
     }

     public function prepareDataSource(array $dataSource)
     {
         if(isset($dataSource['data']['items'])) {
             $fieldName = $this->getData('name');
             foreach($dataSource['data']['items'] as & $item) {
                 $url = '';
                 if($item[$fieldName] != '') {
                     $url = $this->storeManager->getStore()->getBaseUrl(
                             \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
                         ).'testimonial/'.$item[$fieldName];
                 }
                 $item[$fieldName . '_src'] = $url;
                 $item[$fieldName . '_alt'] = $this->getAlt($item) ?: '';
                 $item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
                     'ktpl_testimonial/testimonial/edit',
                     ['testimonial_id' => $item['testimonial_id']]
                 );
                 $item[$fieldName . '_orig_src'] = $url;
             }
         }

         return $dataSource;
     }

     /**
      * @param array $row
      *
      * @return null|string
      */
     protected function getAlt($row)
     {
         $altField = $this->getData('config/altField') ?: self::ALT_FIELD;
         return isset($row[$altField]) ? $row[$altField] : null;
     }
 }