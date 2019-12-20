'use strict';

Ext.namespace('Mailing.page.template');

Ext.onReady(function () {
    MODx.add({
        xtype: 'mailing-page-template-update',
        recordId: MODx.request.id
    });
});

Mailing.page.template.update = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        url: Mailing.config.connectorUrl,
        formpanel: 'mailing-formpanel-template',
        buttons: [{
            text: _('save'),
            process: 'mgr/template/update',
            method: 'remote',
            cls: 'primary-button',
            keys: [{
                key: MODx.config.keymap_save || 's',
                ctrl: true
            }]
        },{
            text: _('mailing.action.add_queues'),
            cls: 'primary-button',
            handler: this.addQueues,
            scope: this
        },{
            text: _('delete'),
            handler: this.delete,
            scope: this
        },{
            text: _('view'),
            handler: this.preview,
            scope: this
        },{
            text: _('close'),
            handler: this.close,
            scope: this
        }],
        components: [{
            xtype: 'mailing-formpanel-template',
            renderTo: 'modx-panel-holder',
            recordId: config.recordId
        }]
    });
    Mailing.page.template.update.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.page.template.update, MODx.Component, {
    addQueues: function () {
        console.log('addQueues');
    },

    delete: function () {
        console.log('delete');
    },

    preview: function () {
        window.open('111');
        return false;
    },

    close: function () {
        MODx.loadPage('mgr/templates', 'namespace=mailing')
    }
});
Ext.reg('mailing-page-template-update', Mailing.page.template.update);
