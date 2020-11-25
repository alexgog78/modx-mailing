'use strict';

Ext.namespace('Mailing.page.template');

Mailing.page.template.update = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        url: Mailing.config.connectorUrl,
        formpanel: 'mailing-formpanel-template',
        components: [{
            xtype: 'mailing-formpanel-template',
            record: config.record
        }],
        buttons: this.getButtons(config),
    });
    Mailing.page.template.update.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.page.template.update, MODx.Component, {
    getButtons: function (config) {
        return [
            this.getUpdateButton(config),
            this.getPreviewButton(config),
            this.getDeleteButton(config),
            this.getCloseButton(config)
        ];
    },

    getUpdateButton: function (config) {
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

    getPreviewButton: function () {
        return {
            text: _('view'),
            handler: this._preview,
            scope: this
        };
    },

    getDeleteButton: function (config) {
        return {
            text: _('delete'),
            handler: this._removeRecord,
            scope: this
        };
    },

    getCloseButton: function (config) {
        return {
            text: _('close'),
            handler: this._close,
            scope: this
        };
    },

    _preview: function () {
        window.open(Mailing.config.previewUrl + '?template=' + this.config.record.id);
    },

    _removeRecord: function () {
        MODx.msg.confirm({
            title: _('delete'),
            text: _('confirm_remove'),
            url: this.config.url,
            params: {
                action: 'mgr/template/remove',
                id: this.config.record.id
            },
            listeners: {
                success: {
                    fn: function (r) {
                        MODx.loadPage('mgr/templates', 'namespace=mailing')
                    }, scope: this
                }
            }
        });
    },

    _close: function () {
        MODx.loadPage('mgr/templates', 'namespace=mailing')
    }
});
Ext.reg('mailing-page-template-update', Mailing.page.template.update);
