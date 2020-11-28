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
        autosave: false,
        fields: [
            'id',
            'queue_id',
            'template_id',
            'template_name',
            'user_id',
            'user_email',
            'user_fullname',
            'status',
            'created_on',
            'properties',
        ],
        columns: [
            this.getGridColumn('id', {header: _('id'), width: 0.05}),
            this.getGridColumn('queue_id', {header: _('mailing_log_queue'), width: 0.1}),
            this.getGridColumn('template_name', {header: _('mailing_log_template'), width: 0.3}),
            this.getGridColumn('user_email', {header: _('mailing_user_email'), width: 0.3}),
            this.getGridColumn('status', {
                header: _('mailing_log_status'),
                width: 0.1,
                renderer: Mailing.renderer.status
            }),
            this.getGridColumn('created_on', {header: _('mailing_log_createdon'), width: 0.1}),
        ],
    });
    Mailing.grid.log.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.grid.log, Mailing.grid, {
    _recordWindow: null,

    getToolbar: function () {
        return [
            '->',
            this._getSearchPanel(),
        ];
    },

    getMenu: function () {
        return [{
            text: _('view'),
            handler: this.viewRecord,
            scope: this
        }, '-', {
            text: _('delete'),
            handler: this.removeRecord,
            scope: this
        }];
    },

    viewRecord: function (btn, e) {
        if (this._recordWindow) {
            this._recordWindow.close();
        }
        this._recordWindow = new MODx.load({
            xtype: 'mailing-window-log',
            title: _('view'),
            record: this.menu.record,
            listeners: {
                success: {
                    fn: this.refresh,
                    scope: this
                }
            }
        });
        this._recordWindow.show(e.target);
    },
});
Ext.reg('mailing-grid-log', Mailing.grid.log);
