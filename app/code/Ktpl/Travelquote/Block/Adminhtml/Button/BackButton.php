<?php

namespace Ktpl\Travelquote\Block\Adminhtml\Button;

use Magento\Backend\Block\Widget\Context;
use Magento\Cms\Api\PageRepositoryInterface;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class BackButton implements ButtonProviderInterface
{
    /**
     * @var Context
     */
    protected $context;

    /**
     * BackButton constructor.
     * @param Context $context
     * @param PageRepositoryInterface $pageRepository
     */
    public function __construct(Context $context, PageRepositoryInterface $pageRepository)
    {
        $this->context = $context;
    }

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl('*/*/')),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getBackUrl($route = '', $params = [])
    {
        return $this->context->getUrlBuilder()->getUrl($route, $params);
    }
}
