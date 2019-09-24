<?php
/*
 * SussexDev_Sample

 * @category   SussexDev
 * @package    SussexDev_Sample
 * @copyright  Copyright (c) 2019 Scott Parsons
 * @license    https://github.com/ScottParsons/module-sampleuicomponent/blob/master/LICENSE.md
 * @version    1.1.2
 */
namespace KTPL\Testimonial\Block\Adminhtml\Button;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{
    /**
     * Get button attributes
     *
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->getTestimonialId()) {
            $data = [
                'label' => __('Delete'),
                'class' => 'delete',
                'on_click' => 'deleteConfirm(\'' . __(
                        'Are you sure you want to do this?'
                    ) . '\', \'' . $this->getDeleteUrl() . '\', {"data": {}})',
                'sort_order' => 20,
            ];
        }
        return $data;
    }

    /**
     * Url to send delete requests to.
     *
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['testimonial_id' => $this->getTestimonialId()]);
    }
}
