'use strict';

Mailing.panel.logs = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-panel-logs';
    }
    Ext.applyIf(config, {
        items: [
            this.getHeader(_('mailing_logs')),
            this.getMainPartPlain([
                this.getDescription(_('mailing_logs_management')),
                this.getContent({xtype: 'mailing-grid-log'}),
            ])
        ],
    });
    Mailing.panel.logs.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.panel.logs, Mailing.panel, {});
Ext.reg('mailing-panel-logs', Mailing.panel.logs);
