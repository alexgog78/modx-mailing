'use strict';

Mailing.panel.templates = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-panel-templates';
    }
    Ext.applyIf(config, {
        cls: 'container',
        items: [
            this.getHeader(_('mailing_templates')),
            {
                layout: 'form',
                items: [
                    this.getDescription(_('mailing_templates_management')),
                    this.getGrid('mailing-grid-template'),
                ]
            }
        ],
    });
    Mailing.panel.templates.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.panel.templates, MODx.FormPanel, {
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

    getGrid: function (xtype) {
        return {
            xtype: xtype,
            cls: 'main-wrapper',
            preventRender: true
        };
    },
});
Ext.reg('mailing-panel-templates', Mailing.panel.templates);
