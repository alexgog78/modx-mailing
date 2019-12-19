'use strict';

Mailing.panel.template = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-panel-template';
    }
    Ext.applyIf(config, {
        pageHeader: _('mailing.section.templates')
    });
    Mailing.panel.template.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.panel.template, Mailing.panel.simple, {
    getContent: function () {
        return [
            this.renderDescription(_('mailing.tab.templates.management')),
            this.renderContent([{xtype: 'mailing-grid-template'}])
        ];
    }
});
Ext.reg('mailing-panel-template', Mailing.panel.template);
Ext.onReady(function () {
    MODx.add({
        xtype: 'mailing-panel-template'
    });
});
