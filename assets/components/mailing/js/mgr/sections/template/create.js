'use strict';

Ext.namespace('Mailing.page.template');

Mailing.page.template.create = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        formpanel: 'mailing-formpanel-template',
        components: [{
            xtype: 'mailing-formpanel-template',
            defaultValues: config.defaultValues,
        }],
        buttons: this.getButtons(config),
    });
    Mailing.page.template.create.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.page.template.create, MODx.Component, {
    getButtons: function (config) {
        return [
            this.getCreateButton(config),
            this.getCloseButton(config)
        ];
    },

    getCreateButton: function(config) {
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

    getCloseButton: function (config) {
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
