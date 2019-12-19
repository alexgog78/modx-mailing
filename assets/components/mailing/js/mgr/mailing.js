'use strict';

var Mailing = function (config) {
    config = config || {};
    //config.namespace = 'mailing';
    Mailing.superclass.constructor.call(this, config);
};
Ext.extend(Mailing, Ext.Component, abstractModule);
Ext.reg('mailing', Mailing);
var Mailing = new Mailing();
//Mailing.function.namespace = Mailing.namespace;
