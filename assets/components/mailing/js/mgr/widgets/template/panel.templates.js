'use strict';

Mailing.panel.templates = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-panel-templates';
    }
    Ext.applyIf(config, {
        items: [
            this.getHeader(_('mailing_template_list')),
            this.getMainPartPlain([
                this.getDescription(_('mailing_template_list_management')),
                this.getContent({xtype: 'mailing-grid-template'}),
            ])
        ],
    });
    Mailing.panel.templates.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.panel.templates, Mailing.panel, {});
Ext.reg('mailing-panel-templates', Mailing.panel.templates);
