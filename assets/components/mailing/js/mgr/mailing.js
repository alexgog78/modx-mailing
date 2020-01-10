'use strict';

var Mailing = function (config) {
    config = config || {};
    Mailing.superclass.constructor.call(this, config);
};
Ext.extend(Mailing, Ext.Component, abstractModule);
Ext.reg('mailing', Mailing);
var Mailing = new Mailing();
