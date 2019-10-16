define(['ko'], function (ko) {
    'use strict';
    return function(){
        const vM = {
            'firstName': ko.observable("hello"),
            'lastName': ko.observable("world")
        };

        vM.fullName = ko.computed(function(){
            return this.firstName() + ' ' + this.lastName();
        }.bind(vM));

        return vM;
    };

});