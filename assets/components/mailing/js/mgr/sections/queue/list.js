'use strict';

Ext.onReady(function () {
    MODx.add({
        xtype: 'mailing-panel-queues'
    });
});

Mailing.panel.queues = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-panel-queue';
    }
    Ext.applyIf(config, {
        pageHeader: _('mailing.section.queues')
    });
    Mailing.panel.queues.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.panel.queues, Mailing.panel.simple, {
    getContent: function () {
        return [
            this.renderDescription(_('mailing.tab.queues.management')),
            this.renderContent([{xtype: 'mailing-grid-queue'}])
        ];
    }
});
Ext.reg('mailing-panel-queues', Mailing.panel.queues);
