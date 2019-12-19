'use strict';

Mailing.grid.template = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-grid-template';
    }
    Ext.applyIf(config, {
        url: Mailing.config.connectorUrl,
        baseParams: {
            action: 'mgr/template/getlist'
        },
        save_action: 'mgr/template/updatefromgrid',
        fields: [
            'id',
            'name',
            'description',
            'user_group_id',
        ],
        gridColumns: {
            'id': {header: _('id'), width: 0.05},
            'name': {header: _('mailing.field.name'), width: 0.2, editor: {xtype: 'textfield'}},
            'description': {header: _('mailing.field.description'), width: 0.6, editor: {xtype: 'textfield'}},
            'user_group_id': {header: _('mailing.field.user_group'), width: 0.2},
        },
        recordActions: {
            xtype: 'mailing-window-template',
            action: {
                create: 'mgr/template/create',
                update: 'mgr/template/update',
                remove: 'mgr/template/remove'
            }
        }
    });
    Mailing.grid.template.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.grid.template, Mailing.grid.abstract, {
    createRecord: function (btn, e) {
        MODx.loadPage(this.recordActions.action.create, 'namespace=mailing');
    },

    updateRecord: function (btn, e) {
        MODx.loadPage(this.recordActions.action.update, 'namespace=mailing&id=' + this.menu.record.id);
    }
});
Ext.reg('mailing-grid-template', Mailing.grid.template);
