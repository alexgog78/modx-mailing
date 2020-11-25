'use strict';

Mailing.grid.log = function (config) {
    config = config || {};
    if (!config.id) {
        config.id = 'mailing-grid-log';
    }
    Ext.applyIf(config, {
        baseParams: {
            action: 'mgr/log/getlist'
        },
        save_action: 'mgr/log/updatefromgrid',
        fields: [
            'id',
            'template_id',
            'template_name',
            'user_id',
            'user_email',
            'user_fullname',
            'created_on',
            'status',
        ],
        columns: [
            this.getGridColumn('id', {header: _('id'), width: 0.05}),
            this.getGridColumn('template_name', {header: _('mailing_record_template'), width: 0.3, renderer: Mailing.renderer.template}),
            this.getGridColumn('user_email', {header: _('mailing_record_user_email'), width: 0.4, renderer: Mailing.renderer.user}),
            this.getGridColumn('status', {header: _('mailing_record_status'), width: 0.1}),
            this.getGridColumn('created_on', {header: _('mailing_record_createdon'), width: 0.1}),
        ],
    });
    Mailing.grid.log.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.grid.log, Mailing.grid, {
    getToolbar: function () {
        return [
            this.getTruncateButton(),
            '->',
            this._getSearchPanel(),
        ];
    },

    getMenu: function () {
        return [{
            text: _('delete'),
            handler: this.removeRecord,
            scope: this
        }];
    },

    getTruncateButton: function (config = {}) {
        return this._getButton(_('mailing_clear_logs'), {
            handler: this.removeRecords,
            scope: this
        });
    },

    removeRecords: function (btn, e) {
        MODx.msg.confirm({
            title: _('delete'),
            text: _('confirm_remove'),
            url: this.config.url,
            params: {
                action: 'mgr/log/removemultiple',
            },
            listeners: {
                success: {fn: this._filterClear, scope: this},
            }
        });
    },

    removeRecord: function (btn, e) {
        MODx.msg.confirm({
            title: _('delete'),
            text: _('confirm_remove'),
            url: this.config.url,
            params: {
                id: this.menu.record.id,
                action: 'mgr/log/remove',
            },
            listeners: {
                success: {fn: this.refresh, scope: this},
            }
        });
    },
});
Ext.reg('mailing-grid-log', Mailing.grid.log);
