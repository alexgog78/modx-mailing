'use strict';

Mailing.panel = function (config) {
    config = config || {};
    Ext.applyIf(config, {
        cls: 'container',
        items: [],
    });
    Mailing.panel.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.panel, MODx.FormPanel, {
    getHeader: function (text) {
        return {
            xtype: 'modx-header',
            itemId: '',
            html: text
        };
    },

    getMainPartPlain: function (items = []) {
        return {
            layout: 'form',
            items: items
        };
    },

    getDescription: function (text) {
        return {
            xtype: 'modx-description',
            itemId: '',
            html: '<p>' + text + '</p>'
        };
    },

    getContent: function (config) {
        return Ext.applyIf(config, {
            cls: 'main-wrapper',
            preventRender: true
        });
    },
});
