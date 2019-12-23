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
            this.renderSendButton(),
            '->',
            this.renderSearchPanel()
        ];
    },

    renderSendButton: function () {
        return {
            text: _('submit'),
            cls: 'primary-button',
            handler: this.send,
            scope: this
        };
    },

    send: function (btn, e) {
        console.log('SEND!!!');
        /*var window = Ext.getCmp(this.recordActions.xtype);
        if (window) {
            window.close();
        }
        window = MODx.load({
            xtype: this.recordActions.xtype,
            title: _('create'),
            parent: this,
            blankValues: true,
            baseParams: {
                action: this.recordActions.action.create
            }
        });
        if (window) {
            window.show(e.target);
        }*/
    },
});
Ext.reg('mailing-grid-queue', Mailing.grid.queue);
