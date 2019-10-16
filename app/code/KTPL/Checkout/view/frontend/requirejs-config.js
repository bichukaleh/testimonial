var config = {
    "map": {
        "*": {
            'Magento_Checkout/js/model/shipping-save-processor/default': 'KTPL_Checkout/js/model/shipping-save-processor/default'
        }
    },
    config: {
        mixins: {
            'Magento_Checkout/js/view/shipping': {
                'KTPL_Checkout/js/mixin/shipping-mixin': true
            }
        }
    }
};