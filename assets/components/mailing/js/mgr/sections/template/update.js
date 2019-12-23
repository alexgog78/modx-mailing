'use strict';

Ext.namespace('Mailing.page.template');

/*Ext.onReady(function () {
    MODx.add({
        xtype: 'mailing-page-template-update',
        recordId: MODx.request.id
    });
});*/

Mailing.page.template.update = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        url: Mailing.config.connectorUrl,
        formpanel: 'mailing-formpanel-template',
        components: [{
            xtype: 'mailing-formpanel-template',
            renderTo: 'modx-panel-holder',
            recordId: config.recordId,
            record: config.record
        }]
    });
    Mailing.page.template.update.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.page.template.update, Mailing.page.abstract, {
    getButtons: function () {
        return [
            this.renderSaveButton(),
            this.renderQueueButton(),
            this.renderDeleteButton(),
            this.renderViewButton(),
            this.renderCloseButton()
        ];
    },

    renderSaveButton: function () {
        return {
            text: _('save'),
            process: 'mgr/template/update',
            method: 'remote',
            cls: 'primary-button',
            keys: [{
                key: MODx.config.keymap_save || 's',
                ctrl: true
            }]
        };
    },

    renderQueueButton: function () {
        return {
            text: _('mailing.action.add_queues'),
            cls: 'primary-button',
            handler: this.addQueues,
            scope: this
        };
    },

    renderDeleteButton: function () {
        return {
            text: _('delete'),
            handler: this.delete,
            scope: this
        };
    },

    renderViewButton: function () {
        return {
            text: _('view'),
            handler: this.preview,
            scope: this
        };
    },

    renderCloseButton: function () {
        return {
            text: _('close'),
            handler: this.close,
            scope: this
        };
    },

    addQueues: function () {
        console.log('addQueues');
    },

    delete: function () {
        MODx.msg.confirm({
            title: _('delete'),
            text: _('confirm_remove'),
            url: this.config.url,
            params: {
                action: 'mgr/template/remove',
                id: this.config.recordId
            },
            listeners: {
                success: {
                    fn: function (r) {
                        MODx.loadPage('mgr/templates', 'namespace=mailing');
                    }, scope: this
                }
            }
        });
    },

    preview: function () {
        window.open(Mailing.config.previewUrl + '?template=' + this.recordId);
    },

    close: function () {
        MODx.loadPage('mgr/templates', 'namespace=mailing')
    }
});
Ext.reg('mailing-page-template-update', Mailing.page.template.update);
