'use strict';

Ext.namespace('Mailing.page.template');

Ext.onReady(function () {
    MODx.add({
        xtype: 'mailing-page-template-create'
    });
});

Mailing.page.template.create = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        url: Mailing.config.connectorUrl,
        formpanel: 'mailing-formpanel-template',
        components: [{
            xtype: 'mailing-formpanel-template',
            renderTo: 'modx-panel-holder'
        }]
    });
    Mailing.page.template.create.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.page.template.create, Mailing.page.abstract, {
    getButtons: function () {
        return [
            this.renderSaveButton(),
            this.renderCloseButton()
        ];
    },

    renderSaveButton: function() {
        return {
            text: _('save'),
            process: 'mgr/template/create',
            method: 'remote',
            reload: true,
            cls: 'primary-button',
            keys: [{
                key: MODx.config.keymap_save || 's',
                ctrl: true
            }]
        };
    },

    renderCloseButton: function () {
        return {
            text: _('close'),
            handler: this.close,
            scope: this
        };
    },

    close: function () {
        MODx.loadPage('mgr/templates', 'namespace=mailing')
    }
});
Ext.reg('mailing-page-template-create', Mailing.page.template.create);
