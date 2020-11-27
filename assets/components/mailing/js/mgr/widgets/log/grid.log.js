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
        ],
        columns: [
            this.getGridColumn('id', {header: _('id'), width: 0.05}),
            this.getGridColumn('queue_id', {header: _('mailing_log_queue'), width: 0.1}),
            this.getGridColumn('template_name', {header: _('mailing_log_template'), width: 0.3, renderer: Mailing.renderer.template}),
            this.getGridColumn('user_email', {header: _('mailing_user_email'), width: 0.3, renderer: Mailing.renderer.user}),
            this.getGridColumn('status', {header: _('mailing_log_status'), width: 0.1, renderer: Mailing.renderer.status}),
            this.getGridColumn('created_on', {header: _('mailing_log_createdon'), width: 0.1}),
        ],
    });
    Mailing.grid.log.superclass.constructor.call(this, config);
};
Ext.extend(Mailing.grid.log, Mailing.grid, {
    getToolbar: function () {
        return [
            '->',
            this._getSearchPanel(),
        ];
    },
});
Ext.reg('mailing-grid-log', Mailing.grid.log);
