'use strict';

Mailing.grid.queue = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-grid-queue';
    }
    Ext.applyIf(config, {
        url: Mailing.config.connectorUrl,
        baseParams: {
            action: 'mgr/queue/getlist'
        },
        save_action: 'mgr/queue/updatefromgrid',
        fields: [
            'id',
            'email',
        ],
        gridColumns: {
            'id': {header: _('id'), width: 0.05},
            'email': {header: _('mailing.field.email'), width: 0.2}
        },
        recordActions: {
            action: {
                remove: 'mgr/queue/remove'
            }
        }
    });
    Mailing.grid.queue.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.grid.queue, Mailing.grid.abstract, {
    getMenu: function () {
        return [{
            text: _('delete'),
            handler: this.removeRecord,
            scope: this
        }];
    },

    renderToolbar: function () {
        return [
            '->',
            this.renderSearchPanel()
        ];
    }
});
Ext.reg('mailing-grid-queue', Mailing.grid.queue);
