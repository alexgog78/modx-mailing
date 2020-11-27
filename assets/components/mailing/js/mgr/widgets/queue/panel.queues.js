'use strict';

Mailing.panel.queues = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-panel-queues';
    }
    Ext.applyIf(config, {
        items: [
            this.getHeader(_('mailing_queue_list')),
            this.getMainPartPlain([
                this.getDescription(_('mailing_queue_list_management')),
                this.getContent({xtype: 'mailing-grid-queue'}),
            ])
        ],
    });
    Mailing.panel.queues.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.panel.queues, Mailing.panel, {});
Ext.reg('mailing-panel-queues', Mailing.panel.queues);
