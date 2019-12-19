'use strict';

var namespace = Mailing;
var grid = namespace.grid.queue;
var xtype = 'mailing-grid-queue';

grid = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = xtype;
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
    grid.superclass.constructor.call(this, config);
};
Ext.extend(grid, namespace.grid.abstract, {
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
Ext.reg(xtype, grid);
