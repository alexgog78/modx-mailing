'use strict';

Ext.namespace('Mailing.page.template');

Mailing.page.template.list = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'mailing-panel-templates'
        }]
    });
    Mailing.page.template.list.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.page.template.list, MODx.Component, {});
Ext.reg('mailing-page-template-list', Mailing.page.template.list);
