'use strict';

Mailing.grid.queue.log = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        baseParams: {
            action: 'mgr/log/getlist',
            queue_id: config.queue_id,
        },
        columns: [
            this.getGridColumn('id', {header: _('id'), width: 0.1}),
            this.getGridColumn('status', {header: _('mailing_log_status'), width: 0.45, renderer: Mailing.renderer.status}),
            this.getGridColumn('created_on', {header: _('mailing_log_createdon'), width: 0.45}),
        ],
    });
    Mailing.grid.queue.log.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.grid.queue.log, Mailing.grid.log, {
    getToolbar: function () {
        return [];
    },
});
Ext.reg('mailing-grid-queue-log', Mailing.grid.queue.log);
