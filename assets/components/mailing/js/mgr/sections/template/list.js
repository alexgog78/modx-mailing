'use strict';

Ext.onReady(function () {
    MODx.add({
        xtype: 'mailing-panel-templates'
    });
});

Mailing.panel.templates = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-panel-template';
    }
    Ext.applyIf(config, {
        pageHeader: _('mailing.section.templates')
    });
    Mailing.panel.templates.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.panel.templates, Mailing.panel.abstract, {
    getContent: function () {
        return [
            this.renderDescription(_('mailing.tab.templates.management')),
            this.renderContent([{xtype: 'mailing-grid-template'}])
        ];
    }
});
Ext.reg('mailing-panel-templates', Mailing.panel.templates);
