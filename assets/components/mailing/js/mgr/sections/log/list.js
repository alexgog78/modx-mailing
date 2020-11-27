'use strict';

Ext.namespace('Mailing.page.log');

Mailing.page.log.list = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'mailing-panel-logs'
        }]
    });
    Mailing.page.log.list.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.page.log.list, Mailing.page, {});
Ext.reg('mailing-page-log-list', Mailing.page.log.list);
