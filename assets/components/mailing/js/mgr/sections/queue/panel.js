'use strict';

Mailing.panel.queue = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-panel-queue';
    }
    Ext.applyIf(config, {
        pageHeader: _('mailing.section.queues')
    });
    Mailing.panel.queue.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.panel.queue, Mailing.panel.simple, {
    getContent: function () {
        return [
            this.renderDescription(_('mailing.tab.queues.management')),
            this.renderContent([{xtype: 'mailing-grid-queue'}])
        ];
    }
});
Ext.reg('mailing-panel-queue', Mailing.panel.queue);
//TODO
Ext.onReady(function () {
    MODx.add({
        xtype: 'mailing-panel-queue'
    });
});
