'use strict';

Ext.namespace('Mailing.page.queue');

Mailing.page.queue.list = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        components: [{
            xtype: 'mailing-panel-queues',
            rate_wait_time: config.rateWaitTime
        }]
    });
    Mailing.page.queue.list.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.page.queue.list, Mailing.page, {});
Ext.reg('mailing-page-queue-list', Mailing.page.queue.list);
