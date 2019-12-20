'use strict';

Ext.namespace('Mailing.page.template');

Ext.onReady(function () {
    MODx.add({
        xtype: 'mailing-page-template-create'
    });
});

Mailing.page.template.create = function (config) {
    config = config || {};
    //console.log(config);
    Ext.applyIf(config, {
        url: Mailing.config.connectorUrl,
        formpanel: 'mailing-formpanel-template',
        buttons: [{
            text: _('save'),
            process: 'mgr/template/create',
            method: 'remote',
            reload: true,
            cls: 'primary-button',
            keys: [{
                key: MODx.config.keymap_save || 's',
                ctrl: true
            }]
        },{
            text: _('close'),
            handler: function() {
                MODx.loadPage('mgr/templates', 'namespace=mailing')
            }
        }],
        components: [{
            xtype: 'mailing-formpanel-template',
            renderTo: 'modx-panel-holder'
        }]
    });
    Mailing.page.template.create.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.page.template.create, MODx.Component);
Ext.reg('mailing-page-template-create', Mailing.page.template.create);
