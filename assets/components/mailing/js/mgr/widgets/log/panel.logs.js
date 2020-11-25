'use strict';

Mailing.panel.logs = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-panel-logs';
    }
    Ext.applyIf(config, {
        cls: 'container',
        items: [
            this.getHeader(),
            {
                layout: 'form',
                items: [
                    this.getDescription(),
                    this.getGrid(),
                ]
            }
        ],
    });
    Mailing.panel.logs.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.panel.logs, MODx.FormPanel, {
    getHeader: function () {
        return {
            xtype: 'modx-header',
            itemId: '',
            html: _('mailing_logs')
        };
    },

    getDescription: function () {
        return {
            xtype: 'modx-description',
            itemId: '',
            html: '<p>' + _('mailing_logs_management') + '</p>'
        };
    },

    getGrid: function () {
        return {
            xtype: 'mailing-grid-log',
            cls: 'main-wrapper',
            preventRender: true
        };
    },
});
Ext.reg('mailing-panel-logs', Mailing.panel.logs);
