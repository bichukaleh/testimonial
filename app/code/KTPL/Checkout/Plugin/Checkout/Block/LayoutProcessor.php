<?php
namespace KTPL\Checkout\Plugin\Checkout\Block;

use KTPL\Checkout\Model\Config;

class LayoutProcessor
{
    /**
     * @var \KTPL\Checkout\Model\Config
     */
    protected $config;

    /**
     * LayoutProcessor constructor.
     *
     * @param Config $config
     */
    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * @param \Magento\Checkout\Block\Checkout\LayoutProcessor $subject
     * @param array $jsLayout
     * @return array
     */
    public function afterProcess(
        \Magento\Checkout\Block\Checkout\LayoutProcessor $subject,
        array $jsLayout
    ) {

        $requiredDeliveryDate =  $this->config->getRequiredDeliveryDate()?: false;
        $jsLayout['components']['checkout']['children']['steps']['children']['shipping-step']['children']
        ['shippingAddress']['children']['shippingAdditional'] = [
            'component' => 'uiComponent',
            'displayArea' => 'shippingAdditional',
            'children' => [
                'delivery_date' => [
                    'component' => 'KTPL_Checkout/js/view/delivery-date-block',
                    'displayArea' => 'delivery-date-block',
                    'deps' => 'checkoutProvider',
                    'dataScopePrefix' => 'delivery_date',
                    'children' => [
                        'form-fields' => [
                            'component' => 'uiComponent',
                            'displayArea' => 'delivery-date-block',
                            'children' => [
                                'delivery_date' => [
                                    'component' => 'KTPL_Checkout/js/view/delivery-date',
                                    'config' => [
                                        'customScope' => 'delivery_date',
                                        'template' => 'ui/form/field',
                                        'elementTmpl' => 'KTPL_Checkout/fields/delivery-date',
                                        'options' => [],
                                        'id' => 'delivery_date',
                                        'data-bind' => ['datetimepicker' => true]
                                    ],
                                    'dataScope' => 'delivery_date.delivery_date',
                                    'label' => 'Delivery Date',
                                    'provider' => 'checkoutProvider',
                                    'visible' => true,
                                    'validation' => [
                                        'required-entry' => $requiredDeliveryDate
                                    ],
                                    'sortOrder' => 10,
                                    'id' => 'delivery_date'
                                ],
                                'delivery_comment' => [
                                    'component' => 'Magento_Ui/js/form/element/textarea',
                                    'config' => [
                                        'customScope' => 'delivery_date',
                                        'template' => 'ui/form/field',
                                        'elementTmpl' => 'ui/form/element/textarea',
                                        'options' => [],
                                        'id' => 'delivery_comment'
                                    ],
                                    'dataScope' => 'delivery_date.delivery_comment',
                                    'label' => 'Comment',
                                    'provider' => 'checkoutProvider',
                                    'visible' => true,
                                    'validation' => [],
                                    'sortOrder' => 20,
                                    'id' => 'delivery_comment'
                                ]
                            ],
                        ],
                    ]
                ]
            ]
        ];

        return $jsLayout;
    }
}