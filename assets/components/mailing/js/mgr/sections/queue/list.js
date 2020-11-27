'use strict';

Ext.namespace('Mailing.page.queue');

Mailing.page.queue.list = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'mailing-panel-queues'
        }]
    });
    Mailing.page.queue.list.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.page.queue.list, MODx.Component, {});
Ext.reg('mailing-page-queue-list', Mailing.page.queue.list);
