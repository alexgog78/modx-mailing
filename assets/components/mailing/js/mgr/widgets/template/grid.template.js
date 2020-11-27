'use strict';

Mailing.grid.template = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-grid-template';
    }
    Ext.applyIf(config, {
        baseParams: {
            action: 'mgr/template/getlist'
        },
        save_action: 'mgr/template/updatefromgrid',
        fields: [
            'id',
            'name',
            'user_group_name',
            'users_count',
        ],
        columns: [
            this.getGridColumn('id', {header: _('id'), width: 0.05}),
            this.getGridColumn('name', {header: _('mailing_template_name'), width: 0.4, editor: {xtype: 'textfield'}}),
            this.getGridColumn('user_group_name', {header: _('mailing_template_user_group'), width: 0.4}),
            this.getGridColumn('users_count', {header: _('mailing_user_count'), width: 0.2}),
        ],
    });
    Mailing.grid.template.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.grid.template, Mailing.grid, {
    getMenu: function () {
        return [{
            text: _('edit'),
            handler: this.updateRecord,
            scope: this
        }, '-', {
            text: _('delete'),
            handler: this.removeRecord,
            scope: this
        }];
    },

    createRecord: function (btn, e) {
        MODx.loadPage('mgr/template/create', 'namespace=mailing');
    },

    updateRecord: function (btn, e) {
        MODx.loadPage('mgr/template/update', 'namespace=mailing&id=' + this.menu.record.id);
    },

    removeRecord: function (btn, e) {
        MODx.msg.confirm({
            title: _('delete'),
            text: _('confirm_remove'),
            url: this.config.url,
            params: {
                id: this.menu.record.id,
                action: 'mgr/template/remove',
            },
            listeners: {
                success: {fn: this.refresh, scope: this},
            }
        });
    },
});
Ext.reg('mailing-grid-template', Mailing.grid.template);
