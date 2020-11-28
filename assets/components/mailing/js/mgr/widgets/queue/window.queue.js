'use strict';

Mailing.window.queue = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        width: 800,
    });
    Mailing.window.queue.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.window.queue, Mailing.window, {
    getFields: function (config) {
        return {
            layout: 'form',
            items: [{
                xtype: 'mailing-grid-queue-log',
                queue_id: config.record.id,
            }]
        };
    },
});
Ext.reg('mailing-window-queue', Mailing.window.queue);
