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
        tabs: true,
        pageHeader: _('mailing.section.queues'),
    });
    Mailing.panel.queues.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.panel.queues, Mailing.panel.abstract, {
    _getContent: function () {
        return [
            this.renderDescription(_('mailing.tab.queues.management')),
            this.renderContent([{xtype: 'mailing-grid-queue'}])
        ];
    },

    getContent: function () {
        //return this.panelContent;
        //var mainForm = this.renderMainForm();
        //var templateForm = this.renderTemplateForm();
        //var usersGrid = this.renderUserGrid();

        return [{
            title: _('mailing.tab.queue.new'),
            items: [
                this.renderDescription(_('mailing.tab.queue.new.management')),
                this.renderContent([{
                    xtype: 'mailing-grid-queue',
                    id: 'mailing-grid-queue-new'
                }])
            ]
        }, {
            title: _('mailing.tab.queue.processed'),
            items: [
                this.renderDescription(_('mailing.tab.queue.processed.management')),
                this.renderContent([{
                    xtype: 'mailing-grid-queue',
                    id: 'mailing-grid-queue-processed'
                }])
            ]
        }];
    },
});
Ext.reg('mailing-panel-queues', Mailing.panel.queues);
