define([
    'jquery',
    'uiComponent',
    'Magento_Checkout/js/model/quote',
    'Magento_Checkout/js/model/step-navigator',
    'Magento_Checkout/js/model/sidebar'
], function ($, Component, quote, stepNavigator, sidebarModel) {
    'use strict';


    var mixin = {

        /**
         * @return {String}
         */
        getShippingMethodTitle: function () {
            var shippingMethod = quote.shippingMethod();

            if(shippingMethod) {
                var shippingMethodContent = shippingMethod['carrier_title'] + ' - ' + shippingMethod['method_title'];

                var shippingMethodCode = shippingMethod['carrier_code'] + '_' + shippingMethod['method_code'];
                var deliveryDate=$('[name="delivery_date"]').val();
                var deliveryComment =$('[name="delivery_comment"]').val();
                if(deliveryDate != '' && deliveryComment != undefined){
                    var html = "<div class='custom-delivery-date'>";
                    html += "<p><b>Delivery Date</b> : " + deliveryDate + " </p>";
                    html += "<p><b>Comment</b> : " + deliveryComment + "</div>";
                    $(html).appendTo('.ship-via');
                }
                if(shippingMethodCode === 'customshipping_customshipping') {

                    console.log("SHIPPING METHOD", shippingMethod, quote);
                }

                return shippingMethodContent;
            }
            return '';
        }
    };

    return function (target) {
        return target.extend(mixin);
    };
});