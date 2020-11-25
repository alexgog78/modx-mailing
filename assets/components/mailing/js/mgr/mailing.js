'use strict';

var Mailing = function (config) {
    config = config || {};
    Ext.applyIf(config, {});
    Mailing.superclass.constructor.call(this, config);
};
Ext.extend(Mailing, Ext.Component, {
    config: {},
    page: {},
    panel: {},
    formPanel: {},
    grid: {},
    localGrid: {},
    window: {},
    tree: {},
    combo: {},
    component: {},
    renderer: {},
    function: {},
});
Ext.reg('mailing', Mailing);
Mailing = new Mailing();
