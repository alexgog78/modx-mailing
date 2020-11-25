'use strict';

Mailing.formPanel = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        url: Mailing.config.connectorUrl,
        baseParams: {},
        forceLayout: true,
        cls: 'container form-with-labels',
        listeners: {
            'setup': {fn: this.setup, scope: this},
            'success': {fn: this.success, scope: this},
            'beforeSubmit': {fn: this.beforeSubmit, scope: this}
        },
        items: [],
    });
    Mailing.formPanel.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.formPanel, MODx.FormPanel, {
    setup: function () {
        if (!this.record) {
            this.setValues(this.defaultValues);
        } else {
            this.setValues(this.record);
        }
        console.log(this.record);
        this.fireEvent('ready', this.record);
        MODx.fireEvent('ready');
    },

    beforeSubmit: function (o) {
        return true;
    },

    success: function (o) {
        this.record = o.result.object;
        return true;
    },

    setValues: function (record) {
        this.getForm().setValues(record);
    },

    getHeader: function (text) {
        return {
            xtype: 'modx-header',
            itemId: '',
            html: text
        };
    },

    getDescription: function (text) {
        return {
            xtype: 'modx-description',
            itemId: '',
            html: '<p>' + text + '</p>'
        };
    },

    getMainPartTabs: function (items = []) {
        return {
            xtype: 'modx-tabs',
            deferredRender: false,
            defaults: {
                autoHeight: true,
                layout: 'form',
                labelWidth: 150,
                bodyCssClass: 'tab-panel-wrapper',
                layoutOnTabChange: true,
            },
            items: items
        };
    },

    getContent: function (items = []) {
        return {
            xtype: 'panel',
            layout: 'form',
            cls: 'main-wrapper',
            //preventRender: true,
            border: false,
            labelAlign: 'top',
            labelSeparator: '',
            defaults: {msgTarget: 'under', anchor: '100%'},
            items: items
        };
    },

    getFormInput: function (name, config = {}) {
        return Ext.applyIf(config, {
            xtype: 'textfield',
            name: name,
            hiddenName: name,
            fieldLabel: name,
            anchor: '100%',
        });
    },
});
