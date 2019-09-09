<?php

namespace KTPL\Testimonial\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class IsApproved extends Column
{
    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory, array $components = [], array $data = [])
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$items) {

                if ($items['is_approved'] == 1) {
                    $items['is_approved'] = 'Approved';
                }elseif ($items['is_approved'] == 0){
                    $items['is_approved'] = 'Pending';
                }else{
                    $items['is_approved'] = 'Disapproved';
                }
            }
        }
        return $dataSource;
    }

}